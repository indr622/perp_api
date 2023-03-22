<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: WarehouseController.php
 * Date: 2022-12-26
 */

namespace App\Http\Controllers\Master;

use App\Models\Master\Warehouse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Warehouse\WarehouseStoreRequest;
use App\Http\Requests\API\Warehouse\WarehouseUpdateRequest;
use App\Http\Resources\Master\WarehouseResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WarehouseController extends Controller
{

    public function index(Request $request)
    {
        $warehouse = Warehouse::where(function ($query) use ($request) {
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
                $query->where('name', 'like', '%' . $request->get('keyword') . '%');
            }
        })
            ->orderBy('created_at', 'DESC')
            ->paginate();
        return new WarehouseResource($warehouse, 'fetchdata', Response::HTTP_OK, 'Warehouse retrieved successfully.');
    }

    public function store(WarehouseStoreRequest $request)
    {
        $warehouse = Warehouse::create($request->all());
        return new WarehouseResource($warehouse, 'store', Response::HTTP_CREATED, 'Warehouse created successfully.');
    }

    public function show($id)
    {
        $warhouse = Warehouse::find($id);
        return new WarehouseResource($warhouse, 'fetchdata', Response::HTTP_OK, 'Warehouse retrieved successfully.');
    }

    public function update(WarehouseUpdateRequest $request, Warehouse $warehouse)
    {
        $warehouse->update($request->all());
        return new WarehouseResource($warehouse, 'update', Response::HTTP_OK, 'Warehouse updated successfully.');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return new WarehouseResource($warehouse, 'delete', Response::HTTP_OK, 'Warehouse deleted successfully.');
    }
}
