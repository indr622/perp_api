<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SupplierController.php
 * Date: 2022-12-26
 */

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Supplier\SupplierStoreRequest;
use App\Http\Requests\API\Supplier\SupplierUpdateRequest;
use App\Http\Resources\Master\SupplierResource;
use App\Models\Master\Supplier;
use App\Repository\Master\SupplierRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends Controller
{

    public function index(Request $request)
    {
        $supplier = Supplier::with('term_payment')->where(function ($query) use ($request) {
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
        return new SupplierResource($supplier, 'fetchdata', Response::HTTP_OK, 'Supplier retrieved successfully.');
    }

    public function store(SupplierStoreRequest $request)
    {
        $supplier = Supplier::create($request->all());

        return new SupplierResource($supplier, 'store', Response::HTTP_CREATED, 'Supplier created successfully.');
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);
        return new SupplierResource($supplier, 'fetchdata', Response::HTTP_OK, 'Supplier retrieved successfully.');
    }

    public function update(SupplierUpdateRequest $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return new SupplierResource($supplier, 'update', Response::HTTP_OK, 'Supplier updated successfully.');
    }
}
