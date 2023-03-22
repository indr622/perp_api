<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\TermShipping;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\TermShipping\TermShippingStoreRequest;
use App\Http\Requests\API\TermShipping\TermShippingUpdateRequest;
use App\Http\Resources\Master\TermShippingResource;
use Symfony\Component\HttpFoundation\Response;

class TermShippingController extends Controller
{

    public function index(Request $request)
    {
        $active = $request->query('active');
        if ($active == 1) {
            $term_shipping = TermShipping::active()->get();
        } else {
            $term_shipping = TermShipping::all();
        }
        return new TermShippingResource($term_shipping, 'fetchdata', Response::HTTP_OK, 'Term Shipping retrieved successfully.');
    }

    public function store(TermShippingStoreRequest $request)
    {
        $term_payment = TermShipping::create($request->all());
        return new TermShippingResource($term_payment, 'store', Response::HTTP_CREATED, 'Term Shipping created successfully.');
    }

    public function show($id)
    {
        $term_payment = TermShipping::find($id)->first();
        return new TermShippingResource($term_payment, 'fetchdata', Response::HTTP_OK, 'Term Shipping retrieved successfully.');
    }

    public function update(TermShippingUpdateRequest $request, $id)
    {
        $term_payment = TermShipping::find($id)->first();
        $term_payment->update($request->all());
        return new TermShippingResource($term_payment, 'update', Response::HTTP_OK, 'Term Shipping updated successfully.');
    }
}
