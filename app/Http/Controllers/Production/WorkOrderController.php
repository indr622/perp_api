<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: WorkOrderController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\order\SalesOrderRepository;

class WorkOrderController extends Controller
{
    protected $salesOrderRepository;

    public function __construct(SalesOrderRepository $salesOrderRepository)
    {
        $this->salesOrderRepository = $salesOrderRepository;
    }


    public function list(Request $request)
    {
        $sales_order = $this->salesOrderRepository->getListByItem($request);
        return response()->json($sales_order);
    }
}
