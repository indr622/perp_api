<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PphController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\Pph;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Pph\PphStoreRequest;
use App\Http\Requests\API\Pph\PphUpdateRequest;
use App\Http\Resources\Master\PphResource;
use Symfony\Component\HttpFoundation\Response;

class PphController extends Controller
{
    public function index(Request $request)
    {
        $active = $request->query('active');

        if ($active == 1) {
            $pph = Pph::active()->orderBy('id', 'ASC')->get();
        } else {
            $pph = Pph::all();
        }
        return new PphResource($pph, 'fetchdata', Response::HTTP_OK, 'PPH retrieved successfully.');
    }

    public function store(PphStoreRequest $request)
    {
        $pph = Pph::create($request->all());
        return new PphResource($pph, 'store', Response::HTTP_CREATED, 'PPH created successfully.');
    }

    public function show(Pph $Pph)
    {
        return new PphResource($Pph, 'fetchdata', Response::HTTP_OK, 'PPH retrieved successfully.');
    }

    public function update(PphUpdateRequest $request, Pph $pph)
    {
        $pph->update($request->all());
        return new PphResource($pph, 'update', Response::HTTP_OK, 'PPH updated successfully.');
    }

    public function destroy($id)
    {
    }
}
