<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: UnitController.php
 * Date: 2022-12-26
 */

namespace App\Http\Controllers\Master;

use App\Models\Master\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Unit\UnitStoreRequest;
use App\Http\Requests\API\Unit\UnitUpdateRequest;
use App\Http\Resources\Master\UnitResource;
use Symfony\Component\HttpFoundation\Response;

class UnitController extends Controller
{

    public function index(Request $request)
    {
        $active = $request->query('active');

        if ($active == 1) {
            $unit = Unit::active()->get();
        } else {
            $unit = Unit::all();
        }
        return new UnitResource($unit, 'fetchdata', Response::HTTP_OK, 'Units retrieved successfully.');
    }

    public function store(UnitStoreRequest $request)
    {

        $unit = Unit::create($request->all());
        return new UnitResource($unit, 'store', Response::HTTP_CREATED, 'Units created successfully.');
    }
    public function show($id)
    {
        $unit = Unit::find($id);
        return new UnitResource($unit, 'fetchdata', Response::HTTP_OK, 'Units retrieved successfully.');
    }

    public function update(UnitUpdateRequest $request, Unit $unit)
    {
        $unit->update($request->all());
        return new UnitResource($unit, 'update', Response::HTTP_OK, 'Units updated successfully.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return new UnitResource($unit, 'delete', Response::HTTP_OK, 'Units deleted successfully.');
    }
}
