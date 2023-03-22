<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: GroupController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use App\Models\Master\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Master\GroupResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\API\Group\GroupStoreRequest;
use App\Http\Requests\API\Group\GroupUpdateRequest;
use App\Repository\Master\GroupRepository;

class GroupController extends Controller
{



    public function index(Request $request)
    {
        if ($request->has('active')) {
            $group = Group::with('sub_group')->active->get();
        } else {
            $group = Group::with('sub_group')->get();
        }
        return new GroupResource($group, 'fetchdata', Response::HTTP_OK, 'Group retrieved successfully.');
    }

    public function store(GroupStoreRequest $request)
    {
        $group = Group::create($request->all());
        return new GroupResource($group, 'store', Response::HTTP_CREATED, 'Group created successfully.');
    }

    public function show($id)
    {
        $group = Group::with('sub_group')->find($id);
        return new GroupResource($group, 'fetchdata', Response::HTTP_OK, 'Group retrieved successfully.');
    }

    public function update(GroupUpdateRequest $request, Group $group)
    {
        $group->update($request->all());
        return new GroupResource($group, 'update', Response::HTTP_OK, 'Group updated successfully.');
    }

    public function destroy($id)
    {
    }
}
