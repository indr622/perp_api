<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: AuthController.php
 * Date: 2022-11-01
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'     => 'required',
            'password'  => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'data'    => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $credentials = $request->only('username', 'password');
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials.',
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }


    public function me()
    {
        $auth = request()->user();
        $user['username']   = $auth->username;
        $user['name']       = $auth->name;
        $user['email']      = $auth->email;
        $user['phone']      = $auth->phone;
        $user['address']    = $auth->address;
        $user['city']       = $auth->city;
        $user['state']      = $auth->state;
        $user['zip']        = $auth->zip;
        $user['role']       = $auth->roles->pluck('name')[0] ?? '';
        $permissions = [];
        foreach (Permission::all() as $permission) {
            if (request()->user()->can($permission->name)) {
                $permissions[] = $permission->name;
            }
        }
        $user['permission'] = $permissions;
        return response()->json($user);
    }


    public function logout(Request $request)
    {
        //remove token
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        if ($removeToken) {
            return response()->json([
                'success' => true,
                'message' => 'Logout success!',
                'status'  => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }



    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return Response()->json([
                'status'        => 0,
                'pid'           => 'update',
                'message'       => ["User ID ($id) failed to update"]
            ], 422);
        }
        $validator = Validator::make($request->all(), [
            'old_password'     => 'required',
            'new_password'      => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'data'    => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Old password is incorrect.',
            ], Response::HTTP_BAD_REQUEST);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json([
            'pid'           => 'update',
            'success'       => true,
            'message'       => 'Password changed successfully.',
        ], Response::HTTP_OK);
    }


    /**
     *  Update user profile endpoint
     * @header Authorization: Bearer {token}
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return Response()->json([
                'status'        => 0,
                'pid'           => 'update',
                'message'       => ["User ID ($id) failed to update"]
            ], 422);
        }
        $validator = Validator::make($request->all(), [
            'username'          => 'required|max:50',
            'name'              => 'required|max:50',
            'phone'             => 'required|max:50',
            'address'           => 'required|max:100',
            'city'              => 'required|max:50',
            'state'             => 'required|max:50',
            'zip'               => 'required|max:5',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error.',
                'data'    => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->username     = $request->username;
        $user->name         = $request->name;
        $user->phone        = $request->phone;
        $user->address      = $request->address;
        $user->city         = $request->city;
        $user->state        = $request->state;
        $user->zip          = $request->zip;
        $user->save();
        return response()->json([
            'pid'           => 'update',
            'success'       => true,
            'message'       => 'Account Settting changed successfully, Please logout and login again.',
        ], Response::HTTP_OK);
    }
}
