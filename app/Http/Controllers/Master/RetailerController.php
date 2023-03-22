<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: RetailerController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use App\Models\Master\Retailer;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Retailer\RetailerStoreRequest;
use App\Http\Requests\API\Retailer\RetailerUpdateRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Master\RetailerResource;
use App\Repository\Master\RetailerRepository;
use Illuminate\Http\Request;

class RetailerController extends Controller
{


    public function index(Request $request)
    {
        $retailer = Retailer::where(function ($query) use ($request) {
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
                    ->orWhere('address', 'like', '%' . $request->get('keyword') . '%');
            }
        })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return new RetailerResource($retailer, 'fetchdata', Response::HTTP_OK, 'Retailers retrieved successfully.');
    }


    public function store(RetailerStoreRequest $request)
    {
        $retailers = Retailer::create($request->all());
        return new RetailerResource($retailers, 'store', Response::HTTP_CREATED, 'Retailers created successfully.');
    }

    public function show($id)
    {
        $retailers = Retailer::findOrFail($id);
        return new RetailerResource($retailers, 'show', Response::HTTP_OK, 'Retailers retrieved successfully.');
    }

    public function update(RetailerUpdateRequest $request, $id)
    {
        $retailers = Retailer::findOrFail($id);
        $retailers->update($request->all());
        return new RetailerResource($retailers, 'update', Response::HTTP_OK, 'Retailers updated successfully.');
    }
}
