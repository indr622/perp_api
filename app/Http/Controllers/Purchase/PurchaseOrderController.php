<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: QuotationController.php
 * Date: 2022-11-01
 */

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\purchase\PurchaseOrderRepository;
use App\Http\Resources\Purchase\PurchaseOrderResource;
use App\Http\Requests\API\PurchaseOrder\PurchaseOrderStoreRequest;

class PurchaseOrderController extends Controller
{

    protected $purchaseOrderRepository;

    public function __construct(
        PurchaseOrderRepository $purchaseOrderRepository
    ) {
        $this->purchaseOrderRepository = $purchaseOrderRepository;
    }
    public function index(Request $request)
    {
        $purchase_order = $this->purchaseOrderRepository->findAll($request);
        return new PurchaseOrderResource($purchase_order,  'fetchdata', Response::HTTP_CREATED, 'Purchase Order retrieved successfully.');
    }

    public function balance(Request $request)
    {
        $purchase_order = $this->purchaseOrderRepository->findAllBalance($request);
        return new PurchaseOrderResource($purchase_order,  'fetchdata', Response::HTTP_CREATED, 'Purchase Order retrieved successfully.');
    }

    public function store(PurchaseOrderStoreRequest $request)
    {
        $purchase_order = $this->purchaseOrderRepository->store($request);
        return new PurchaseOrderResource($purchase_order,  'store', Response::HTTP_CREATED, 'Purchase Order created successfully.');
    }

    public function show($id)
    {
        $purchase_order = $this->purchaseOrderRepository->findOne($id);
        return new PurchaseOrderResource($purchase_order,  'fetchdata', Response::HTTP_CREATED, 'Purchase Order retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        $purchase_order = $this->purchaseOrderRepository->update($request, $id);
        return new PurchaseOrderResource($purchase_order,  'update', Response::HTTP_CREATED, 'Purchase Order updated successfully.');
    }


    public function destroy($id)
    {
        //
    }
}
