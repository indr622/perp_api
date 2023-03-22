<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SalesInvoiceRepository.php
 * Date: 2023-02-13
 */

namespace App\Repository\sales;

use Exception;
use App\Constant\GlobalConstant;
use App\Models\Sales\SalesInvoice;
use App\Models\Sales\SalesInvoiceDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesInvoiceRepository
{
    public function findAll($request)
    {

        $sales_invoice = SalesInvoice::select(
            'id',
            'sales_order_id',
            'purchase_shipping_id',
            'customer_id',
            'inv_number',
            'inv_date',
            'inv_delivery_date',
            'inv_status',
            'inv_total',
            'created_by',
        )
            ->with([
                'customer' => function ($query) {
                    $query->select('id', 'name');
                },
                'sales_order' => function ($query) {
                    $query->select('id', 'currency_id', 'retailer_id', 'so_number', 'so_order_date', 'so_rate');
                },
                'sales_order.retailer' => function ($query) {
                    $query->select('id', 'name');
                },
                'sales_order.currency' => function ($query) {
                    $query->select('id', 'name');
                },
                'sales_invoice_details',
            ])
            ->withCount('sales_invoice_details as item_count')
            ->when($request->from_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetween('inv_date', [$request->from_date, $request->end_date]);
            })
            ->when($request->status == GlobalConstant::INV_STATUS_CANCEL, function ($query) {
                $query->where('inv_status', GlobalConstant::INV_STATUS_CANCEL);
            })
            ->when($request->status == GlobalConstant::INV_STATUS_PAID, function ($query) {
                $query->where('inv_status', GlobalConstant::INV_STATUS_PAID);
            })
            ->when($request->status == GlobalConstant::INV_STATUS_UNPAID, function ($query) {
                $query->where('inv_status', GlobalConstant::INV_STATUS_UNPAID);
            })
            ->when($request->status == GlobalConstant::INV_STATUS_UNPAID, function ($query) {
                $query->where('inv_status', GlobalConstant::INV_STATUS_UNPAID);
            })
            ->orderBy('sales_invoices.created_at', 'DESC')
            ->paginate(10);

        return $sales_invoice;
    }

    public function findOne($id)
    {
        $sales_invoice = SalesInvoice::with([
            'sales_order',
            'sales_order.retailer',
            'sales_order.currency',
            'customer',
            'sales_invoice_details',
        ])->find($id);
        return $sales_invoice;
    }

    public function store($request)
    {
        $invoice = new SalesInvoice();
        try {
            DB::beginTransaction();
            $invoice = SalesInvoice::create([
                'sales_order_id'            => $request->sales_order_id,
                'purchase_shipping_id'      => $request->purchase_shipping_id,
                'customer_id'               => $request->customer_id,

                'inv_number'                => $invoice->generateNewNumber(),
                'document_no'               => $request->document_no,
                'inv_date'                  => $request->invoice_date,
                'inv_delivery_date'         => $request->delivery_date,
                'inv_status'                => $request->status,

                'shipping_name'             => $request->shipping_name,
                'shipping_email'            => $request->shipping_email,
                'shipping_phone'            => $request->shipping_phone,
                'shipping_address'          => $request->shipping_address,
                'term_payment'              => $request->term_payment,
                'created_by'                => Auth::user()->name,

                'inv_subtotal'              => $request->subtotal,
                'inv_discount'              => $request->discount,
                'inv_additional_cost'       => $request->additional_cost,
                'inv_vat'                   => $request->vat,
                'inv_prepaid'               => $request->prepaid,
                'inv_total'                 => $request->total,
            ]);

            foreach ($request->product_list as $detail) {
                SalesInvoiceDetail::create([
                    'sales_invoice_id'      => $invoice->id,
                    'product_id'            => $detail['product_id'],
                    'price_sell'            => $detail['price_sell'],
                    'qty'                   => $detail['qty'],
                    'amount'                => $detail['amount'],
                    'remark'                => $detail['remark'],
                ]);
            }
            DB::commit();
            return $invoice;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function update($request, $id)
    {
    }

    public function delete($id)
    {
    }
}
