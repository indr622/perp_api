<?php

namespace App\Http\Controllers\Widget;

use Illuminate\Http\Request;
use App\Constant\GlobalConstant;
use App\Http\Controllers\Controller;
use App\Models\Purchase\PurchaseShipping;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Purchase\PurchaseShippingResource;

class PurchaseShippingWidgetController extends Controller
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

        $widget['total_purchase_shipping']          = PurchaseShipping::whereBetween('shp_request_date', [$from_date, $end_date])->count();
        $widget['total_purchase_shipping_amount']   = PurchaseShipping::whereBetween('shp_request_date', [$from_date, $end_date])->sum('shp_total');


        $widget['total_purchase_shipping_process']  = PurchaseShipping::whereBetween('shp_request_date', [$from_date, $end_date])
            ->where('shp_status', GlobalConstant::SHP_STATUS_PROCESS)
            ->count();
        $widget['total_purchase_shipping_process_amount']   = PurchaseShipping::whereBetween('shp_request_date', [$from_date, $end_date])
            ->where('shp_status', GlobalConstant::SHP_STATUS_PROCESS)
            ->sum('shp_total');

        $widget['total_purchase_shipping_finish']  = PurchaseShipping::whereBetween('shp_request_date', [$from_date, $end_date])
            ->where('shp_status', GlobalConstant::SHP_STATUS_FINISH)
            ->count();
        $widget['total_purchase_shipping_finish_amount']   = PurchaseShipping::whereBetween('shp_request_date', [$from_date, $end_date])
            ->where('shp_status', GlobalConstant::SHP_STATUS_FINISH)
            ->sum('shp_total');

        $widget['total_purchase_shipping_delivery']  = PurchaseShipping::whereBetween('shp_request_date', [$from_date, $end_date])
            ->where('shp_status', GlobalConstant::SHP_STATUS_DELIVERY)
            ->count();
        $widget['total_purchase_shipping_delivery_amount']   = PurchaseShipping::whereBetween('shp_request_date', [$from_date, $end_date])
            ->where('shp_status', GlobalConstant::SHP_STATUS_DELIVERY)
            ->sum('shp_total');

        $widget['total_purchase_shipping_cancel']  = PurchaseShipping::whereBetween('shp_request_date', [$from_date, $end_date])
            ->where('shp_status', GlobalConstant::SHP_STATUS_CANCEL)
            ->count();
        $widget['total_purchase_shipping_cancel_amount']   = PurchaseShipping::whereBetween('shp_request_date', [$from_date, $end_date])
            ->where('shp_status', GlobalConstant::SHP_STATUS_CANCEL)
            ->sum('shp_total');
        return response()->json(['data' => $widget]);
    }
}
