<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PurchaseOrderRepository.php
 * Date: 2023-02-13
 */

namespace App\Repository\purchase;

use Exception;
use App\Constant\GlobalConstant;
use App\Models\Master\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase\PurchaseOrder;
use App\Models\Purchase\PurchaseOrderDetail;

class PurchaseOrderRepository
{
    public function findAll($request)
    {
        $purchase_order = PurchaseOrder::select(
            'id',
            'po_number',
            'supplier_id',
            'po_order_date',
            'po_request_date',
            'po_status',
            'po_total',
            'created_by',

        )
            ->with([
                'purchase_order_details',
                'supplier' => function ($query) {
                    $query->select('id', 'name', 'email', 'phone', 'address');
                }
            ])
            ->withCount('purchase_order_details as item_count')

            ->when($request->from_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetween('po_order_date', [$request->from_date, $request->end_date]);
            })
            ->when($request->status == GlobalConstant::PO_STATUS_FINISH, function ($query) {
                $query->where('po_status', GlobalConstant::PO_STATUS_FINISH);
            })
            ->when($request->status == GlobalConstant::PO_STATUS_PROCESS, function ($query) {
                $query->where('po_status', GlobalConstant::PO_STATUS_PROCESS);
            })
            ->when($request->status == GlobalConstant::PO_STATUS_CANCEL, function ($query) {
                $query->where('po_status', GlobalConstant::PO_STATUS_CANCEL);
            })
            ->orderBy('purchase_orders.created_at', 'DESC')
            ->paginate(10);

        return $purchase_order;
    }

    public function findAllBalance($request)
    {
        $purchase_order = PurchaseOrder::select(
            'id',
            'po_number',
            'supplier_id',
            'po_order_date',
            'po_request_date',
            'po_status',
            'po_total',
            'created_by',

        )
            ->with([
                'purchase_order_details',
                'supplier' => function ($query) {
                    $query->select('id', 'name', 'email', 'phone', 'address');
                }
            ])
            ->withCount('purchase_order_details as item_count')

            ->when($request->from_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetween('po_order_date', [$request->from_date, $request->end_date]);
            })
            ->when($request->status == GlobalConstant::PO_STATUS_FINISH, function ($query) {
                $query->where('po_status', GlobalConstant::PO_STATUS_FINISH);
            })
            ->when($request->status == GlobalConstant::PO_STATUS_PROCESS, function ($query) {
                $query->where('po_status', GlobalConstant::PO_STATUS_PROCESS);
            })
            ->when($request->status == GlobalConstant::PO_STATUS_CANCEL, function ($query) {
                $query->where('po_status', GlobalConstant::PO_STATUS_CANCEL);
            })
            ->whereHas('purchase_order_details', function ($query) {
                $query->where('balance', '>', 0);
            })
            ->orderBy('purchase_orders.created_at', 'DESC')
            ->paginate(10);

        return $purchase_order;
    }



    public function findOne($id)
    {
        $purchase_order = PurchaseOrder::select(
            'id',
            'sales_order_id',
            'currency_id',
            'supplier_id',
            'pph_id',
            'term_shipping_id',
            'po_number',
            'po_use_vat',
            'po_rate',
            'po_order_date',
            'po_request_date',
            'po_discount_percent',
            'po_discount_nominal',
            'shipping_name',
            'shipping_address',
            'shipping_phone',
            'shipping_email',
            'shipping_mark',
            'term_payment',
            'po_status',
            'po_type',
            'po_subtotal',
            'po_discount',
            'po_vat',
            'po_pph',
            'po_total'
        )
            ->with([
                'sales_order' => function ($query) {
                    $query->select('id', 'so_number',);
                },
                'sales_order.sales_order_details' => function ($query) {
                    $query->select('id', 'sales_order_id', 'product_id', 'price_sell');
                },
                'supplier' => function ($query) {
                    $query->select('id', 'term_payment_id', 'name', 'email', 'phone', 'address');
                },
                'supplier.term_payment' => function ($query) {
                    $query->select('id', 'name');
                },
                'purchase_order_details' => function ($query) {
                    $query->select('id', 'sales_order_detail_id', 'purchase_order_id', 'product_id', 'item_id', 'price_buy', 'qty', 'balance', 'remark')->where('balance', '>', 0);
                },
                'purchase_order_details.sales_order_detail' => function ($query) {
                    $query->select('id', 'price_sell');
                },
                'purchase_order_details.product' => function ($query) {
                    $query->select('id', 'name', 'description', 'unit_id');
                },

            ])->find($id);
        return $purchase_order;
    }

    public function store($request)
    {
        $po = new PurchaseOrder();
        try {
            DB::beginTransaction();
            $purchase_order = PurchaseOrder::create([
                'sales_order_id'            => $request->sales_order_id,
                'currency_id'               => $request->currency_id,
                'supplier_id'               => $request->supplier_id,
                'pph_id'                    => $request->pph_id,
                'term_shipping_id'           => $request->term_shipping_id,

                'po_number'                 => $po->generateNewNumber(),
                'po_type'                   => $request->type,
                'po_status'                 => $request->status,
                'po_use_vat'                => $request->use_vat,
                'po_rate'                   => $request->rate,
                'po_order_date'             => $request->order_date,
                'po_request_date'           => $request->request_date,
                'po_discount_percent'       => $request->discount_percent,
                'po_discount_nominal'       => $request->discount_nominal,
                'shipping_name'             => $request->shipping_name,
                'shipping_phone'            => $request->shipping_phone,
                'shipping_email'            => $request->shipping_email,
                'shipping_address'          => $request->shipping_address,
                'shipping_mark'             => $request->shipping_mark,
                'term_payment'              => $request->term_payment,
                'created_by'                => Auth::user()->name,

                'po_subtotal'               => $request->subtotal,
                'po_discount'               => $request->discount,
                'po_vat'                    => $request->vat,
                'po_pph'                    => $request->pph,
                'po_total'                  => $request->total,
            ]);

            if ($request->type == GlobalConstant::PO_TYPE_PRODUCT) {
                foreach ($request->product_list as $detail) {
                    PurchaseOrderDetail::create([
                        'purchase_order_id'     => $purchase_order->id,
                        'sales_order_detail_id' => $detail['sales_order_detail_id'] ?? null,
                        'product_id'            => $detail['product_id'],
                        'item_id'               => null,
                        'price_buy'             => $detail['price_buy'],
                        'qty'                   => $detail['qty'],
                        'balance'               => $detail['qty'],
                        'remark'                => $detail['remark'],
                    ]);
                }
            } else {
                foreach ($request->item_list as $detail) {
                    PurchaseOrderDetail::create([
                        'purchase_order_id'     => $purchase_order->id,
                        'sales_order_detail_id' => $detail['sales_order_detail_id'] ?? null,
                        'product_id'            => null,
                        'item_id'               => $detail['id'],
                        'price_buy'             => $detail['price_buy'],
                        'qty'                   => $detail['qty'],
                        'balance'               => $detail['qty'],
                        'remark'                => $detail['remark'],
                    ]);
                }
            }

            DB::commit();
            return $purchase_order;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function update($request, $id)
    {
        $purchase_order = PurchaseOrder::findOrFail($id);
        try {
            DB::beginTransaction();
            $purchase_order->update([
                'sales_order_id'            => $request->sales_order_id,
                'currency_id'               => $request->currency_id,
                'supplier_id'               => $request->supplier_id,
                'pph_id'                    => $request->pph_id,
                'term_shipping_id'           => $request->term_shipping_id,

                'po_type'                   => $request->type,
                'po_status'                 => $request->status,
                'po_use_vat'                => $request->use_vat,
                'po_rate'                   => $request->rate,
                'po_order_date'             => $request->order_date,
                'po_request_date'           => $request->request_date,
                'po_discount_percent'       => $request->discount_percent,
                'po_discount_nominal'       => $request->discount_nominal,
                'shipping_name'             => $request->shipping_name,
                'shipping_phone'            => $request->shipping_phone,
                'shipping_address'          => $request->shipping_address,
                'shipping_mark'             => $request->shipping_mark,
                'term_payment'              => $request->term_payment,

                'po_subtotal'               => $request->subtotal,
                'po_discount'               => $request->discount,
                'po_vat'                    => $request->vat,
                'po_pph'                    => $request->pph,
                'po_total'                  => $request->total,
            ]);
            $purchase_order->purchase_order_details()->delete();
            if ($request->type == GlobalConstant::PO_TYPE_PRODUCT) {
                foreach ($request->product_list as $detail) {
                    PurchaseOrderDetail::create([
                        'purchase_order_id'     => $purchase_order->id,
                        'product_id'            => $detail['product_id'],
                        'item_id'               => null,
                        'price_buy'             => $detail['price_buy'],
                        'qty'                   => $detail['qty'],
                        'remark'                => $detail['remark'],
                    ]);
                }
            } else {
                foreach ($request->item_list as $detail) {
                    PurchaseOrderDetail::create([
                        'purchase_order_id'     => $purchase_order->id,
                        'product_id'            => null,
                        'item_id'               => $detail['item_id'],
                        'price_buy'             => $detail['price_buy'],
                        'qty'                   => $detail['qty'],
                        'remark'                => $detail['remark'],
                    ]);
                }
            }
            DB::commit();
            return $purchase_order;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
