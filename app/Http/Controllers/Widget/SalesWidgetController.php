<?php

namespace App\Http\Controllers\Widget;

use App\Constant\GlobalConstant;
use Illuminate\Http\Request;
use App\Models\Order\SalesOrder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SalesWidgetController extends Controller
{
    public function index(Request $request)
    {
        $sales_order = SalesOrder::where(function ($query) use ($request) {
            if ($dateFrom = $request->get("date-from") && $dateTo = $request->get("date-to")) {
                $query->whereDateBetween($dateFrom, $dateTo);
            }
        })->get(
            array(
                DB::raw('SUM(total_amount) as total_price'),
                DB::raw('COUNT(subtotal_amount) as subtotal_price'),
            )
        );
        return response()->json($sales_order);
    }
}
