<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\TermPayment;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\TermPayment\TermPaymentStoreRequest;
use App\Http\Requests\API\TermPayment\TermPaymentUpdateRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Master\TermPaymentResource;

class TermPaymentController extends Controller
{

    public function index(Request $request)
    {
        $active = $request->query('active');
        if ($active == 1) {
            $term_payment = TermPayment::active()->get();
        } else {
            $term_payment = TermPayment::all();
        }
        return new TermPaymentResource($term_payment, 'fetchdata', Response::HTTP_OK, 'Term Payment retrieved successfully.');
    }


    public function store(TermPaymentStoreRequest $request)
    {
        $term_payment = TermPayment::create($request->all());
        return new TermPaymentResource($term_payment, 'store', Response::HTTP_CREATED, 'Term Payment created successfully.');
    }

    public function show($id)
    {
        $term_payment = TermPayment::find($id)->first();
        return new TermPaymentResource($term_payment, 'fetchdata', Response::HTTP_OK, 'Term Payment retrieved successfully.');
    }

    public function update(TermPaymentUpdateRequest $request, $id)
    {
        $term_payment = TermPayment::find($id)->first();
        $term_payment->update($request->all());
        return new TermPaymentResource($term_payment, 'update', Response::HTTP_OK, 'Term Payment updated successfully.');
    }

    public function destroy($id)
    {
    }
}
