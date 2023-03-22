<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: CurrencyController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\Customer;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Master\CustomerResource;
use App\Http\Requests\API\Customer\CustomerStoreRequest;
use App\Http\Requests\API\Customer\CustomerUpdateRequest;

class CustomerController extends Controller
{


    public function index(Request $request)
    {
        $customer = Customer::with('term_payment')->where(function ($query) use ($request) {
            if ($request->has('status')) {
                if ($request->get("status") == "Active") {
                    $query->active();
                } else if ($request->get("status") == "Inactive") {
                    $query->inactive();
                } else {
                    $query;
                }
            }
            if ($request->has('keyword')) {
                $query->where('name', 'like', '%' . $request->get('keyword') . '%')
                    ->orWhere('email', 'like', '%' . $request->get('keyword') . '%')
                    ->orWhere('phone', 'like', '%' . $request->get('keyword') . '%');
            }
        })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);


        return new CustomerResource($customer, 'fetchdata', Response::HTTP_OK, 'Customers retrieved successfully.');
    }

    public function store(CustomerStoreRequest $request)
    {
        $customer = Customer::create($request->all());


        return new CustomerResource($customer, 'store', Response::HTTP_CREATED, 'Customer stored successfully.');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return new CustomerResource($customer, 'fetchdata', Response::HTTP_OK, 'Customers retrieved successfully.');
    }

    public function update(CustomerUpdateRequest $request, $id)
    {
        $customer = Customer::find($id);
        $customer->update($request->except('details'));
        return new CustomerResource($customer, 'update', Response::HTTP_OK, 'Customer updated successfully.');
    }
}
