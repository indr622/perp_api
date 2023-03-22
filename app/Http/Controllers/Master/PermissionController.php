<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PermissionController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Master\PermissionResource;

class PermissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $permissions = Permission::all();
        return new PermissionResource($permissions, 'fetchdata', Response::HTTP_OK, 'Permissions retrieved successfully.');
    }
}
