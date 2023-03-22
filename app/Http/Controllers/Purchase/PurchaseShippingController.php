<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\purchase\PurchaseShippingRepository;
use App\Http\Resources\Purchase\PurchaseShippingResource;
use App\Http\Requests\API\PurchaseShipping\PurchaseShippingStoreRequest;
use App\Http\Requests\API\PurchaseShipping\PurchaseShippingUpdateRequest;

class PurchaseShippingController extends Controller
{
    protected $purchaseShippingRepository;

    public function __construct(
        PurchaseShippingRepository $purchaseShippingRepository
    ) {
        $this->purchaseShippingRepository = $purchaseShippingRepository;
    }


    public function index(Request $request)
    {
        $purchase_shipping = $this->purchaseShippingRepository->findAll($request);
        return new PurchaseShippingResource($purchase_shipping,  'fetchdata', Response::HTTP_OK, 'Purchase Shipping retrieved successfully.');
    }
    public function show($id)
    {
        $purchase_shipping = $this->purchaseShippingRepository->findOne($id);
        return new PurchaseShippingResource($purchase_shipping,  'fetchdata', Response::HTTP_OK, 'Purchase Shipping retrieved successfully.');
    }

    public function store(PurchaseShippingStoreRequest $request)
    {
        $purchase_shipping = $this->purchaseShippingRepository->store($request);
        return new PurchaseShippingResource($purchase_shipping,  'store', Response::HTTP_CREATED, 'Purchase Shipping created successfully.');
    }
    public function update(PurchaseShippingUpdateRequest $request, $id)
    {
        $purchase_shipping = $this->purchaseShippingRepository->update($request, $id);
        return new PurchaseShippingResource($purchase_shipping,  'update', Response::HTTP_CREATED, 'Purchase Order updated successfully.');
    }


    public function destroy($id)
    {
        //
    }
}
