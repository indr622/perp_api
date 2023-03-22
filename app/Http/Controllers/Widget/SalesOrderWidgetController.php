<?php

namespace App\Http\Controllers\Widget;

use Illuminate\Http\Request;
use App\Constant\GlobalConstant;
use App\Models\Order\SalesOrder;
use App\Http\Controllers\Controller;

class SalesOrderWidgetController extends Controller
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

        $widget['total_sales_order']          = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])->count();
        $widget['total_sales_order_amount']   = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])->sum('so_total');

        $widget['total_sales_order_pending']  = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])
            ->where('so_status', GlobalConstant::SO_STATUS_PENDING)
            ->count();
        $widget['total_sales_order_pending_amount']   = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])
            ->where('so_status', GlobalConstant::SO_STATUS_PENDING)
            ->sum('so_total');

        $widget['total_sales_order_process']  = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])
            ->where('so_status', GlobalConstant::SO_STATUS_PROCESS)
            ->count();
        $widget['total_sales_order_process_amount']   = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])
            ->where('so_status', GlobalConstant::SO_STATUS_PROCESS)
            ->sum('so_total');

        $widget['total_sales_order_finish']  = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])
            ->where('so_status', GlobalConstant::SO_STATUS_FINISH)
            ->count();
        $widget['total_sales_order_finish_amount']   = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])
            ->where('so_status', GlobalConstant::SO_STATUS_FINISH)
            ->sum('so_total');

        $widget['total_sales_order_cancel']  = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])
            ->where('so_status', GlobalConstant::SO_STATUS_CANCEL)
            ->count();
        $widget['total_sales_order_cancel_amount']   = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])
            ->where('so_status', GlobalConstant::SO_STATUS_CANCEL)
            ->sum('so_total');

        $widget['total_sales_order_hold']  = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])
            ->where('so_status', GlobalConstant::SO_STATUS_HOLD)
            ->count();
        $widget['total_sales_order_hold_amount']   = SalesOrder::whereBetween('so_order_date', [$from_date, $end_date])
            ->where('so_status', GlobalConstant::SO_STATUS_HOLD)
            ->sum('so_total');

        return response()->json(['data' => $widget]);
    }
}
