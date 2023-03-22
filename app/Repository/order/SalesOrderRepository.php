<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SalesOrderRepository.php
 * Date: 2023-02-13
 */

namespace App\Repository\order;

use Exception;
use App\Constant\GlobalConstant;
use App\Models\Order\SalesOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order\SalesOrderDetail;

class SalesOrderRepository
{
    public function findAll($request)
    {
        $search = '%' . $request->get('keyword') . '%';

        $sales_order = SalesOrder::with(['customer', 'customer.term_payment', 'retailer', 'currency'])
            ->withCount(['sales_order_details'])
            ->when($request->from_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetween('so_order_date', [$request->from_date, $request->end_date]);
            })
            ->when($request->status == GlobalConstant::SO_STATUS_PENDING, function ($query) {
                $query->where('so_status', GlobalConstant::SO_STATUS_PENDING);
            })
            ->when($request->status == GlobalConstant::SO_STATUS_FINISH, function ($query) {
                $query->where('so_status', GlobalConstant::SO_STATUS_FINISH);
            })
            ->when($request->status == GlobalConstant::SO_STATUS_PROCESS, function ($query) {
                $query->where('so_status', GlobalConstant::SO_STATUS_PROCESS);
            })
            ->when($request->status == GlobalConstant::SO_STATUS_CANCEL, function ($query) {
                $query->where('so_status', GlobalConstant::SO_STATUS_CANCEL);
            })
            ->when($request->status == GlobalConstant::SO_STATUS_HOLD, function ($query) {
                $query->where('so_status', GlobalConstant::SO_STATUS_HOLD);
            })
            ->where('so_number', 'like', $search)
            ->orderBy('so_order_date', 'DESC')
            ->paginate(10);

        return $sales_order;
    }
    public function findOne($id)
    {
        $sales_order = SalesOrder::with([
            'customer', 'customer.term_payment', 'retailer', 'currency', 'sales_order_details.product', 'sales_order_details.product.item', 'sales_order_details.product.unit', 'sales_order_details'
            => function ($query) {
                $query->select(
                    'id',
                    'sales_order_id',
                    'product_id',
                    'price_sell',
                    'qty',
                    'amount',
                    'remark',
                );
            },
        ])->find($id);

        return $sales_order;
    }

    public function store($request)
    {
        $so = new SalesOrder();
        try {
            DB::beginTransaction();
            $sales_order = SalesOrder::create([
                'quotation_id'          => $request->quotation_id,
                'currency_id'           => $request->currency_id,
                'customer_id'           => $request->customer_id,
                'type_order_id'         => $request->type_order_id,
                'retailer_id'           => $request->retailer_id,
                'term_shipping_id'      => $request->term_shipping_id,

                'customer_po'           => $request->customer_po,
                'so_number'             => $so->generateNewNumber(),
                'so_use_vat'            => $request->use_vat ? true : false,
                'so_rate'               => $request->rate,
                'so_order_date'         => $request->order_date,
                'so_request_date'       => $request->request_date,
                'so_discount_percent'   => $request->discount_percent,
                'so_discount_nominal'   => $request->discount_nominal,

                'so_shipping_name'     => $request->shipping_name,
                'so_shipping_email'    => $request->shipping_email,
                'so_shipping_phone'    => $request->shipping_phone,
                'so_shipping_address'  => $request->shipping_address,

                'so_subtotal'          => $request->subtotal,
                'so_discount'          => $request->discount,
                'so_additional_cost'   => $request->vat,
                'so_vat'               => $request->additional_cost,
                'so_total'             => $request->total,
                'so_status'            => GlobalConstant::SO_STATUS_PROCESS,
                'so_created_by'        => Auth::user()->name ?? null,
                'so_term_payment'      => $request->term_payment,
                'so_term_and_condition' => 'test',
            ]);

            foreach ($request->product_list as $detail) {
                SalesOrderDetail::create([
                    'sales_order_id'        => $sales_order->id,
                    'product_id'            => $detail['product_id'],
                    'qty'                   => $detail['qty'],
                    'price_sell'            => $detail['price_sell'],
                    'remark'                => $detail['remark'],
                ]);
            }

            DB::commit();
            return $sales_order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($request, $id)
    {
        $sales_order = SalesOrder::find($id);
        try {
            DB::beginTransaction();
            $sales_order->update([
                'quotation_id'          => $request->quotation_id,
                'currency_id'           => $request->currency_id,
                'customer_id'           => $request->customer_id,
                'type_order_id'         => $request->type_order_id,
                'retailer_id'           => $request->retailer_id,
                'term_shipping_id'      => $request->term_shipping_id,

                'customer_po'           => $request->customer_po,
                'so_use_vat'            => $request->use_vat ? true : false,
                'so_rate'               => $request->rate,
                'so_order_date'         => $request->order_date,
                'so_request_date'       => $request->request_date,
                'so_discount_percent'   => $request->discount_percent,
                'so_discount_nominal'   => $request->discount_nominal,

                'so_shipping_name'     => $request->shipping_name,
                'so_shipping_email'    => $request->shipping_email,
                'so_shipping_phone'    => $request->shipping_phone,
                'so_shipping_address'  => $request->shipping_address,

                'so_subtotal'          => $request->subtotal,
                'so_discount'          => $request->discount,
                'so_additional_cost'   => $request->vat,
                'so_vat'               => $request->additional_cost,
                'so_total'             => $request->total,
                'so_created_by'        => Auth::user()->name ?? null,
                'so_term_payment'      => $request->term_payment,
                'so_term_and_condition' => 'test',
            ]);
            $sales_order->sales_order_details()->delete();
            foreach ($request->product_list as $detail) {
                SalesOrderDetail::create([
                    'sales_order_id'        => $sales_order->id,
                    'product_id'            => $detail['product_id'],
                    'qty'                   => $detail['qty'],
                    'price_sell'            => $detail['price_sell'],
                    'remark'                => $detail['remark'],
                ]);
            }

            DB::commit();
            return $sales_order;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
