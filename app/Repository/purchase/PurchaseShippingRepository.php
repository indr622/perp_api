<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PurchaseShippingRepository.php
 * Date: 2023-02-13
 */

namespace App\Repository\purchase;

use Exception;
use App\Constant\GlobalConstant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase\PurchaseShipping;
use App\Models\Purchase\PurchaseOrderDetail;
use App\Models\Purchase\PurchaseShippingDetail;

class PurchaseShippingRepository
{
    public function findAll($request)
    {
        $purchase_shipping = PurchaseShipping::with(['purchase_order', 'purchase_order.supplier', 'purchase_order.term_shipping', 'purchase_order.term_payment'])
            ->withCount('purchase_shipping_details as item_count')
            ->when($request->from_date && $request->end_date, function ($query) use ($request) {
                $query->whereBetween('shp_request_date', [$request->from_date, $request->end_date]);
            })
            ->orderBy('purchase_shippings.created_at', 'DESC')
            ->paginate(10);

        return $purchase_shipping;
    }
    public function findOne($id)
    {
        $purchase_shipping = PurchaseShipping::with('purchase_order', 'purchase_order.sales_order', 'purchase_order.sales_order.customer', 'purchase_order.supplier', 'purchase_order.term_shipping', 'purchase_order.term_payment', 'purchase_shipping_details', 'purchase_shipping_details.product', 'purchase_shipping_details.item')
            ->find($id);
        return $purchase_shipping;
    }
    public function store($request)
    {

        $shipping = new PurchaseShipping();
        try {
            DB::beginTransaction();
            $purchase_shipping = PurchaseShipping::create([
                'purchase_order_id'         => $request->purchase_order_id,
                'shp_number'                => $shipping->generateNewNumber(),
                'shp_request_date'          => $request->request_date,
                'created_by'                => Auth::user()->name,
                'shp_status'                => GlobalConstant::SHP_STATUS_PROCESS,
                'note'                      => $request->note,
                'shp_subtotal'              => $request->subtotal,
                'shp_discount'              => $request->discount,
                'shp_vat'                   => $request->vat,
                'shp_pph'                   => $request->pph,
                'shp_total'                 => $request->total,

            ]);


            if ($request->type == GlobalConstant::PO_TYPE_PRODUCT) {
                foreach ($request->product_list as $detail) {
                    PurchaseShippingDetail::create([
                        'purchase_shipping_id'      => $purchase_shipping->id,
                        'purchase_order_detail_id'  => $detail['purchase_order_detail_id'],
                        'product_id'                => $detail['product_id'],
                        'item_id'                   => null,
                        'price'                     => $detail['price'],
                        'qty'                       => $detail['qty'],
                        'qty_delivery'              => $detail['qty_delivery'],
                        'remark'                    => $detail['remark'],
                    ]);
                    $po_detail = PurchaseOrderDetail::find($detail['purchase_order_detail_id']);
                    $po_detail->update([
                        'balance' => $po_detail->balance - $detail['qty_delivery']
                    ]);
                }
            } else {
                foreach ($request->item_list as $detail) {
                    PurchaseShippingDetail::create([
                        'purchase_shipping_id'      => $purchase_shipping->id,
                        'purchase_order_detail_id'  => $detail['id'],
                        'product_id'                => null,
                        'item_id'                   => $detail['item_id'],
                        'price'                     => $detail['price'],
                        'qty'                       => $detail['qty'],
                        'qty_delivery'              => $detail['qty_delivery'],
                        'remark'                    => $detail['remark'],
                    ]);
                    $po_detail = PurchaseOrderDetail::find($detail['id']);
                    $po_detail->update([
                        'balance' => $po_detail->balance - $detail['qty_delivery']
                    ]);
                }
            }

            DB::commit();
            return $purchase_shipping;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function update($request, $id)
    {
        $purchase_shipping = PurchaseShipping::find($id);
        try {
            DB::beginTransaction();
            $purchase_shipping->update([
                'purchase_order_id'         => $request->purchase_order_id,
                'shp_request_date'          => $request->request_date,
                'created_by'                => Auth::user()->name,
                'shp_status'                => GlobalConstant::SHP_STATUS_PROCESS,
                'note'                      => $request->note,
                'shp_subtotal'              => $request->subtotal,
                'shp_discount'              => $request->discount,
                'shp_vat'                   => $request->vat,
                'shp_pph'                   => $request->pph,
                'shp_total'                 => $request->total,
            ]);

            $purchase_shipping->purchase_shipping_details()->delete();

            if ($request->type == GlobalConstant::PO_TYPE_PRODUCT) {
                foreach ($request->product_list as $detail) {
                    PurchaseShippingDetail::create([
                        'purchase_shipping_id'      => $purchase_shipping->id,
                        //'purchase_order_detail_id'  => $detail['id'],
                        'product_id'                => $detail['product_id'],
                        'item_id'                   => null,
                        'price_buy'                 => $detail['price_buy'],
                        'qty'                       => $detail['qty'],
                        'qty_delivery'              => $detail['qty_delivery'],
                        'remark'                    => $detail['remark'],
                    ]);
                }
            } else {
                foreach ($request->item_list as $detail) {
                    PurchaseShippingDetail::create([
                        'purchase_shipping_id'      => $purchase_shipping->id,
                        //'purchase_order_detail_id'  => $detail['id'],
                        'product_id'                => null,
                        'item_id'                   => $detail['item_id'],
                        'price_buy'                 => $detail['price_buy'],
                        'qty'                       => $detail['qty'],
                        'qty_delivery'              => $detail['qty_delivery'],
                        'remark'                    => $detail['remark'],
                    ]);
                }
            }

            DB::commit();
            return $purchase_shipping;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
