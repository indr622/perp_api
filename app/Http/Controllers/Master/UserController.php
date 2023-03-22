<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: UserController.php
 * Date: 2022-12-26
 */

namespace App\Http\Controllers\Master;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\UserStoreRequest;
use App\Http\Requests\API\User\UserUpdateRequest;
use App\Http\Resources\Master\UserResource;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->get();
        return new UserResource($users, 'fetchdata', Response::HTTP_OK, 'Users retrieved successfully.');
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active,
        ]);
        $user->assignRole($request->role);
        return new UserResource($user, 'store', Response::HTTP_CREATED, 'Users created successfully.');
    }

    public function show(User $user)
    {
        return new UserResource($user, 'fetchdata', Response::HTTP_OK, 'Users retrieved successfully.');
    }


    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return new UserResource($user, 'update', Response::HTTP_OK, 'Users updated successfully.');
    }
}
