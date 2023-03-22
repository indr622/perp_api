<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PaymentMethodController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\PaymentMethod\PaymentMethodStoreRequest;
use App\Http\Requests\API\PaymentMethod\PaymentMethodUpdateRequest;
use App\Models\Master\PaymentMethod;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Master\PaymentMethodResource;

class PaymentMethodController extends Controller
{

    public function index()
    {
        $payment_method = PaymentMethod::all();
        return new PaymentMethodResource($payment_method, 'fetchdata', Response::HTTP_OK, 'Payment Method retrieved successfully.');
    }

    public function store(PaymentMethodStoreRequest $request)
    {
        $payment_method = PaymentMethod::create($request->all());
        return new PaymentMethodResource($payment_method, 'store', Response::HTTP_CREATED, 'Payment Method created successfully.');
    }

    public function show(PaymentMethod $paymentMethod)
    {
        return new PaymentMethodResource($paymentMethod, 'fetchdata', Response::HTTP_OK, 'Data retrieved successfully.');
    }

    public function update(PaymentMethodUpdateRequest $request, PaymentMethod $paymentMethod)
    {

        $paymentMethod->update($request->all());
        return new PaymentMethodResource($paymentMethod, 'update', Response::HTTP_OK, 'Payment Method updated successfully.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return new PaymentMethodResource($paymentMethod, 'delete', Response::HTTP_OK, 'Payment Method deleted successfully.');
    }
}
