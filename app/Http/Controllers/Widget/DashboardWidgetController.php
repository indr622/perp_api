<?php

namespace App\Http\Controllers\Widget;

use Illuminate\Http\Request;
use App\Models\Order\Quotation;
use App\Http\Controllers\Controller;
use App\Models\Order\SalesOrder;
use App\Models\Purchase\PurchaseOrder;

class DashboardWidgetController extends Controller
{
    public function __invoke(Request $request)
    {
        $from_date = $request->from_date;
        $end_date = $request->end_date;
        $widget = [];

        $widget['total_quotation']                  = Quotation::count();
        $widget['total_quotation_amount']           = Quotation::sum('quo_total');

        $widget['total_sales_order']                = SalesOrder::count();
        $widget['total_sales_order_amount']         = SalesOrder::sum('so_total');

        $widget['total_purchase_order']             = PurchaseOrder::count();
        $widget['total_purchase_order_amount']      = PurchaseOrder::sum('po_total');

        return response()->json(['data' => $widget]);
    }
}
