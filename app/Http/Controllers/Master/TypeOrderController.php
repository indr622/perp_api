<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: TypeOrderController.php
 * Date: 2022-12-26
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\TypeOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\TypeOrder\TypeOrderStoreRequest;
use App\Http\Requests\API\TypeOrder\TypeOrderUpdateRequest;
use App\Http\Resources\Master\TypeOrderResource;
use Symfony\Component\HttpFoundation\Response;

class TypeOrderController extends Controller
{
    public function index(Request $request)
    {
        $active = $request->query('active');

        if ($active == 1) {
            $type_order = TypeOrder::active()->get();
        } else {
            $type_order = TypeOrder::all();
        }
        return new TypeOrderResource($type_order, 'fetchdata', Response::HTTP_OK, 'Type Order retrieved successfully.');
    }

    public function store(TypeOrderStoreRequest $request)
    {
        $type_order = TypeOrder::create($request->all());
        return new TypeOrderResource($type_order, 'store', Response::HTTP_CREATED, 'Type Order created successfully.');
    }
    public function show($id)
    {
        $type_order = TypeOrder::find($id);
        return new TypeOrderResource($type_order, 'fetchdata', Response::HTTP_OK, 'Type Order retrieved successfully.');
    }

    public function update(TypeOrderUpdateRequest $request, TypeOrder  $type_order)
    {
        $type_order->update($request->all());
        return new TypeOrderResource($type_order, 'update', Response::HTTP_OK, 'Type Order updated successfully.');
    }

    public function destroy(TypeOrder  $type_order)
    {
        $type_order->delete();
        return new TypeOrderResource($type_order, 'delete', Response::HTTP_OK, 'Type Order deleted successfully.');
    }
}
