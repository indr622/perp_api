<?php

namespace App\Http\Controllers\Widget;

use App\Constant\GlobalConstant;
use App\Http\Controllers\Controller;
use App\Models\Order\Quotation;
use Illuminate\Http\Request;

class QuotationWidgetController extends Controller
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

        $widget['total_quotation']          = Quotation::whereBetween('quo_order_date', [$from_date, $end_date])->count();
        $widget['total_quotation_amount']   = Quotation::whereBetween('quo_order_date', [$from_date, $end_date])->sum('quo_total');

        $widget['total_quotation_pending']  = Quotation::whereBetween('quo_order_date', [$from_date, $end_date])->where(
            'quo_status',
            GlobalConstant::QUO_STATUS_PENDING
        )->count();
        $widget['total_quotation_pending_amount']   = Quotation::whereBetween('quo_order_date', [$from_date, $end_date])->where(
            'quo_status',
            GlobalConstant::QUO_STATUS_PENDING
        )->sum('quo_total');

        $widget['total_quotation_finish']  = Quotation::whereBetween('quo_order_date', [$from_date, $end_date])->where(
            'quo_status',
            GlobalConstant::QUO_STATUS_FINISH
        )->count();
        $widget['total_quotation_finish_amount']   = Quotation::whereBetween('quo_order_date', [$from_date, $end_date])->where(
            'quo_status',
            GlobalConstant::QUO_STATUS_FINISH
        )->sum('quo_total');

        $widget['total_quotation_process']  = Quotation::whereBetween('quo_order_date', [$from_date, $end_date])->where(
            'quo_status',
            GlobalConstant::QUO_STATUS_PROCESS
        )->count();
        $widget['total_quotation_process_amount']   = Quotation::whereBetween('quo_order_date', [$from_date, $end_date])->where(
            'quo_status',
            GlobalConstant::QUO_STATUS_PROCESS
        )->sum('quo_total');

        $widget['total_quotation_cancel']  = Quotation::whereBetween('quo_order_date', [$from_date, $end_date])->where(
            'quo_status',
            GlobalConstant::QUO_STATUS_CANCEL
        )->count();
        $widget['total_quotation_cancel_amount']   = Quotation::whereBetween('quo_order_date', [$from_date, $end_date])->where(
            'quo_status',
            GlobalConstant::QUO_STATUS_CANCEL
        )->sum('quo_total');


        return response()->json(['data' => $widget]);
    }
}
