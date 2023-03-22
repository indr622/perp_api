<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: CurrencyController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\Currency;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Master\CurrencyResource;
use App\Http\Requests\API\Currency\CurrencyStoreRequest;
use App\Http\Requests\API\Currency\CurrencyUpdateRequest;

class CurrencyController extends Controller
{

    public function index(Request $request)
    {
        $active = $request->query('active');

        if ($active == 1) {
            $currency = Currency::active()->orderBy('id', 'ASC')->get();
        } else {
            $currency = Currency::all();
        }
        return new CurrencyResource($currency, 'fetchdata', Response::HTTP_OK, 'Currency retrieved successfully.');
    }

    public function store(CurrencyStoreRequest $request)
    {

        $currency = Currency::create($request->all());
        return new CurrencyResource($currency, 'store', Response::HTTP_CREATED, 'Currency created successfully.');
    }

    public function show(Currency $currency)
    {
        return new CurrencyResource($currency, 'fetchdata', Response::HTTP_OK, 'Currency retrieved successfully.');
    }

    public function update(CurrencyUpdateRequest $request, Currency $currency)
    {
        $currency->update($request->all());
        return new CurrencyResource($currency, 'update', Response::HTTP_OK, 'Currency updated successfully.');
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();
        return new CurrencyResource($currency, 'delete', Response::HTTP_OK, 'Currency deleted successfully.');
    }
}
