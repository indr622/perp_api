<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SubGroupController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\SubGroup;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Master\SubGroupResource;
use App\Http\Requests\API\SubGroup\SubGroupStoreRequest;
use App\Http\Requests\API\SubGroup\SubGroupUpdateRequest;

class SubGroupController extends Controller
{
    public function index(Request $request)
    {
        $group_id = $request->get('group_id');
        if ($group_id) {
            $subgroup = SubGroup::where('group_id', $request->group_id)->active()->get();
        } else {
            $subgroup = SubGroup::with('group')->get();
        }
        return new SubGroupResource($subgroup, 'fetchdata', Response::HTTP_OK, 'Sub Group retrieved successfully.');
    }

    public function store(SubGroupStoreRequest $request)
    {
        $subgroup = SubGroup::create($request->all());
        return new SubGroupResource($subgroup, 'store', Response::HTTP_CREATED, 'Sub Group created successfully.');
    }

    public function show($id)
    {
        $subgroup = SubGroup::with('group')->find($id);
        return new SubGroupResource($subgroup, 'fetchdata', Response::HTTP_OK, 'Sub Group retrieved successfully.');
    }
    public function update(SubGroupUpdateRequest $request, SubGroup $subgroup)
    {
        $subgroup->update($request->all());
        return new SubGroupResource($subgroup, 'update', Response::HTTP_OK, 'Sub Group update successfully.');
    }
    public function destroy(SubGroup $subgroup)
    {
        $subgroup->delete();
        return new SubGroupResource($subgroup, 'delete', Response::HTTP_OK, 'Sub Group deleted successfully.');
    }
}
