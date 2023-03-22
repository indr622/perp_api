<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: QuotationController.php
 * Date: 2022-11-01
 */

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Models\Order\SalesOrder;
use App\Http\Controllers\Controller;
use App\Repository\order\SalesOrderRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Order\SalesOrderResource;
use App\Http\Requests\API\SalesOrder\SalesOrderStoreRequest;
use App\Http\Requests\API\SalesOrder\SalesOrderUpdateRequest;

class SalesOrderController extends Controller
{

    protected $salesOrderRepository;

    public function __construct(
        SalesOrderRepository $salesOrderRepository
    ) {
        $this->salesOrderRepository = $salesOrderRepository;
    }


    public function index(Request $request)
    {
        $sales_order = $this->salesOrderRepository->findAll($request);
        return new SalesOrderResource($sales_order,  'fetchdata', Response::HTTP_CREATED, 'Sales Order retrieved successfully.');
    }

    public function list(Request $request)
    {
        $sales_order = $this->salesOrderRepository->getListByItem($request);
        return new SalesOrderResource($sales_order,  'fetchdata', Response::HTTP_CREATED, 'Order List retrieved successfully.');
    }

    public function store(SalesOrderStoreRequest $request)
    {
        $sales_order = $this->salesOrderRepository->store($request);
        return new SalesOrderResource($sales_order,  'store', Response::HTTP_CREATED, 'Sales Order created successfully.');
    }


    public function show($id)
    {
        $sales_order = $this->salesOrderRepository->findOne($id);

        if (!$sales_order) {
            return new SalesOrderResource(null,  'fetchdata', Response::HTTP_OK, 'Sales Order not found');
        }

        return new SalesOrderResource($sales_order,  'fetchdata', Response::HTTP_OK, 'Sales Order retrieved successfully.');
    }


    public function update(SalesOrderUpdateRequest $request, $id)
    {
        $sales_order = $this->salesOrderRepository->update($request, $id);

        if (!$sales_order) {
            return new SalesOrderResource(null,  'update', Response::HTTP_OK, 'Sales Order not found');
        }

        return new SalesOrderResource($sales_order,  'update', Response::HTTP_OK, 'Sales Order updated successfully.');
    }
}
