<?php

namespace App\Http\Controllers\Widget;

use Illuminate\Http\Request;
use App\Constant\GlobalConstant;
use App\Http\Controllers\Controller;
use App\Models\Purchase\PurchaseOrder;

class PurchaseWidgetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $from_date = $request->from_date;
        $end_date = $request->end_date;
        $widget = [];

        $widget['total_purchase_order']          = PurchaseOrder::whereBetween('po_order_date', [$from_date, $end_date])->count();
        $widget['total_purchase_order_amount']   = PurchaseOrder::whereBetween('po_order_date', [$from_date, $end_date])->sum('po_total');

        $widget['total_purchase_order_process']  = PurchaseOrder::whereBetween('po_order_date', [$from_date, $end_date])
            ->where('po_status', GlobalConstant::PO_STATUS_PROCESS)
            ->count();
        $widget['total_purchase_order_process_amount']   = PurchaseOrder::whereBetween('po_order_date', [$from_date, $end_date])
            ->where('po_status', GlobalConstant::PO_STATUS_PROCESS)
            ->sum('po_total');

        $widget['total_purchase_order_finish']  = PurchaseOrder::whereBetween('po_order_date', [$from_date, $end_date])
            ->where('po_status', GlobalConstant::PO_STATUS_FINISH)
            ->count();
        $widget['total_purchase_order_finish_amount']   = PurchaseOrder::whereBetween('po_order_date', [$from_date, $end_date])
            ->where('po_status', GlobalConstant::PO_STATUS_FINISH)
            ->sum('po_total');

        $widget['total_purchase_order_delivery']  = PurchaseOrder::whereBetween('po_order_date', [$from_date, $end_date])
            ->where('po_status', GlobalConstant::PO_STATUS_DELIVERY)
            ->count();
        $widget['total_purchase_order_delivery_amount']   = PurchaseOrder::whereBetween('po_order_date', [$from_date, $end_date])
            ->where('po_status', GlobalConstant::PO_STATUS_DELIVERY)
            ->sum('po_total');

        $widget['total_purchase_order_cancel']  = PurchaseOrder::whereBetween('po_order_date', [$from_date, $end_date])
            ->where('po_status', GlobalConstant::PO_STATUS_CANCEL)
            ->count();
        $widget['total_purchase_order_cancel_amount']   = PurchaseOrder::whereBetween('po_order_date', [$from_date, $end_date])
            ->where('po_status', GlobalConstant::PO_STATUS_CANCEL)
            ->sum('po_total');
        return response()->json(['data' => $widget]);
    }
}
