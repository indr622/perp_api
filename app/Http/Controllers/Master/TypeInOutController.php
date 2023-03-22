<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SubGroupController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\TypeInOut;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Master\TypeInOutResource;
use App\Http\Requests\API\TypeInOut\TypeInOutStoreRequest;
use App\Http\Requests\API\TypeInOut\TypeInOutUpdateRequest;

class TypeInOutController extends Controller
{

    public function index()
    {
        $typeInOut = TypeInOut::all();
        return new TypeInOutResource($typeInOut, 'fetchdata', Response::HTTP_OK, 'Type In Out retrieved successfully.');
    }


    public function store(TypeInOutStoreRequest $request)
    {
        $typeInOut = TypeInOut::create($request->all());
        return new TypeInOutResource($typeInOut, 'store', Response::HTTP_CREATED, 'Type In Out created successfully.');
    }


    public function show(TypeInOut $typeInOut)
    {
        return new TypeInOutResource($typeInOut, 'fetchdata', Response::HTTP_OK, 'Type In Out retrieved successfully.');
    }



    public function update(TypeInOutUpdateRequest $request, TypeInOut $typeInOut)
    {
        $typeInOut->update($request->all());
        return new TypeInOutResource($typeInOut, 'update', Response::HTTP_OK, 'Type In Out update successfully.');
    }


    public function destroy(TypeInOut $typeInOut)
    {
        $typeInOut->delete();
        return new TypeInOutResource($typeInOut, 'delete', Response::HTTP_OK, 'Type In Out deleted successfully.');
    }
}
