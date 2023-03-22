<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: ProductionStepController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ProductionStep\ProductionStepStoreRequest;
use App\Http\Requests\API\ProductionStep\ProductionStepUpdateRequest;
use App\Models\Master\ProductionStep;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Master\ProductionStepResource;

class ProductionStepController extends Controller
{

    public function index()
    {
        $prod_step = ProductionStep::all();
        return new ProductionStepResource($prod_step, 'fetchdata', Response::HTTP_OK, 'Production Step retrieved successfully.');
    }

    public function store(ProductionStepStoreRequest $request)
    {
        $prod_step = ProductionStep::create($request->all());
        return new ProductionStepResource($prod_step, 'store', Response::HTTP_CREATED, 'Production Step created successfully.');
    }

    public function show(ProductionStep $ProductionStep)
    {
        return new ProductionStepResource($ProductionStep, 'fetchdata', Response::HTTP_OK, 'Production Step retrieved successfully.');
    }

    public function update(ProductionStepUpdateRequest $request, $id)
    {
        $prod_step = ProductionStep::findOrFail($id);
        $prod_step->update($request->all());
        return new ProductionStepResource($prod_step, 'update', Response::HTTP_OK, 'Production Step updated successfully.');
    }

    public function destroy(ProductionStep $prod_step)
    {
        $prod_step->delete();
        return new ProductionStepResource($prod_step, 'delete', Response::HTTP_OK, 'Production Step deleted successfully.');
    }
}
