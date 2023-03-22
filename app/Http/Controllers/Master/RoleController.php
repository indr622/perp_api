<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: RoleController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Master\RoleResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\API\Role\RoleStoreRequest;
use App\Http\Requests\API\Role\RoleUpdateRequest;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return new RoleResource($role, 'fetchdata', Response::HTTP_OK, 'Roles retrieved successfully.');
    }
    public function show($id)
    {
        $role = Role::find($id)->first();
        return new RoleResource($role, 'fetchdata', Response::HTTP_OK, 'Roles retrieved successfully.');
    }
    public function store(RoleStoreRequest $request)
    {
        $role = Role::create($request->all());
        return new RoleResource($role, 'store', Response::HTTP_CREATED, 'Roles created successfully.');
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->update($request->all());
        return new RoleResource($role, 'update', Response::HTTP_OK, 'Roles updated successfully.');
    }

    public function rolepermissions($id)
    {
        $role = Role::findByID($id);
        if (is_null($role)) {
            return new RoleResource("Role ID ($id) notfound", 'fetchdata', Response::HTTP_UNPROCESSABLE_ENTITY, 'Roles retrieved successfully.');
        }
        return new RoleResource($role->permissions, 'fetchdata', Response::HTTP_OK, 'Fetch permission ' . $role->name . ' retrieved successfully.');
    }

    public function setRolePermission(Request $request)
    {

        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permissions);
        return new RoleResource($role, 'update', Response::HTTP_OK, 'Roles Permission updated successfully.');
    }
}
