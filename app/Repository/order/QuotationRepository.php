<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: QuotationRepository.php
 * Date: 2023-02-13
 */

namespace App\Repository\order;

use Exception;
use App\Models\User;
use App\Models\Order\Quotation;
use App\Constant\GlobalConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order\QuotationDetail;
use App\Notifications\QuotationNotification;
use Illuminate\Support\Facades\Notification;

class QuotationRepository
{
    public function findAll($request)
    {
        $quotation = Quotation::with(['customer', 'retailer', 'currency'])
            ->withCount(['quotation_details'])
            ->when($request->from_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetween('quo_order_date', [$request->from_date, $request->end_date]);
            })
            ->when($request->status == GlobalConstant::QUO_STATUS_PENDING, function ($query) {
                $query->where('quo_status', GlobalConstant::QUO_STATUS_PENDING);
            })
            ->when($request->status == GlobalConstant::QUO_STATUS_FINISH, function ($query) {
                $query->where('quo_status', GlobalConstant::QUO_STATUS_FINISH);
            })
            ->when($request->status == GlobalConstant::QUO_STATUS_PROCESS, function ($query) {
                $query->where('quo_status', GlobalConstant::QUO_STATUS_PROCESS);
            })
            ->when($request->status == GlobalConstant::QUO_STATUS_CANCEL, function ($query) {
                $query->where('quo_status', GlobalConstant::QUO_STATUS_CANCEL);
            })
            ->when($request->status == GlobalConstant::QUO_STATUS_HOLD, function ($query) {
                $query->where('quo_status', GlobalConstant::QUO_STATUS_HOLD);
            })
            ->orderBy('quo_order_date', 'DESC')
            ->paginate(10);

        return $quotation;
    }

    public function findOne($id)
    {
        $quotation = Quotation::with([
            'customer', 'term_shipping', 'retailer', 'currency', 'quotation_details.product', 'quotation_details.product.item', 'quotation_details.product.unit', 'quotation_details'
            => function ($query) {
                $query->select(
                    'id',
                    'quotation_id',
                    'product_id',
                    'price_sell',
                    'qty',
                    'amount',
                    'remark',
                );
            },
        ])->find($id);

        return $quotation;
    }

    public function store($request)
    {
        $quo = new Quotation();
        try {
            DB::beginTransaction();
            $quotation = Quotation::create([
                'customer_id'           => $request->customer_id,
                'retailer_id'           => $request->retailer_id,
                'currency_id'           => $request->currency_id,
                'type_order_id'         => $request->type_order_id,
                'term_shipping_id'      => $request->term_shipping_id,

                'customer_po'           => $request->customer_po,
                'quo_number'            => $quo->generateNewNumber(),
                'quo_use_vat'           => $request->use_vat ? true : false,
                'quo_rate'              => $request->rate,
                'quo_order_date'        => $request->order_date,
                'quo_request_date'      => $request->request_date,
                'quo_discount_percent'  => $request->discount_percent,
                'quo_discount_nominal'  => $request->discount_nominal,

                'quo_shipping_name'     => $request->shipping_name,
                'quo_shipping_email'    => $request->shipping_email,
                'quo_shipping_phone'    => $request->shipping_phone,
                'quo_shipping_address'  => $request->shipping_address,

                'quo_subtotal'          => $request->subtotal,
                'quo_discount'          => $request->discount,
                'quo_vat'               => $request->vat,
                'quo_additional_cost'   => $request->additional_cost,
                'quo_total'             => $request->total,
                'quo_status'            => GlobalConstant::QUO_STATUS_PROCESS,
                'quo_created_by'        => Auth::user()->name ?? null,
                'quo_term_payment'      => $request->term_payment,
                'quo_term_and_condition' => 'test',
            ]);

            foreach ($request->product_list as $product) {
                QuotationDetail::create([
                    'quotation_id'      => $quotation->id,
                    'product_id'        => $product['product_id'],
                    'qty'               => $product['qty'],
                    'price_sell'        => $product['price_sell'],
                    'remark'            => $product['remark'],
                ]);
            }

            DB::commit();
            // $user = $request->user();
            // $users = User::find(1)->get();
            // Notification::send($users, new QuotationNotification($quotation, $user));
            return $quotation;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($request, $id)
    {
        $quotation = Quotation::find($id);
        try {
            DB::beginTransaction();
            $quotation->update([
                'customer_id'           => $request->customer_id,
                'retailer_id'           => $request->retailer_id,
                'currency_id'           => $request->currency_id,
                'type_order_id'         => $request->type_order_id,
                'term_shipping_id'      => $request->term_shipping_id,

                'customer_po'           => $request->customer_po,
                'quo_use_vat'           => $request->use_vat ? true : false,
                'quo_rate'              => $request->rate,
                'quo_order_date'        => $request->order_date,
                'quo_request_date'      => $request->request_date,
                'quo_discount_percent'  => $request->discount_percent,
                'quo_discount_nominal'  => $request->discount_nominal,

                'quo_shipping_name'     => $request->shipping_name,
                'quo_shipping_email'    => $request->shipping_email,
                'quo_shipping_phone'    => $request->shipping_phone,
                'quo_shipping_address'  => $request->shipping_address,

                'quo_subtotal'          => $request->subtotal,
                'quo_discount'          => $request->discount,
                'quo_vat'               => $request->vat,
                'quo_additional_cost'   => $request->additional_cost,
                'quo_total'             => $request->total,
                'quo_created_by'        => Auth::user()->name ?? null,
                'quo_term_payment'      => $request->term_payment,
                'quo_term_and_condition' => 'test',
            ]);
            $quotation->quotation_details()->delete();

            foreach ($request->product_list as $product) {
                QuotationDetail::create([
                    'quotation_id'      => $quotation->id,
                    'product_id'        => $product['product_id'],
                    'qty'               => $product['qty'],
                    'price_sell'        => $product['price_sell'],
                    'remark'            => $product['remark'],
                ]);
            }
            DB::commit();
            return $quotation;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
