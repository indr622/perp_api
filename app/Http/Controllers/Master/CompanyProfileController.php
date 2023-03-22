<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: CompanyProfileController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\CompanyProfile;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Master\CompanyProfileResource;
use App\Models\Master\CompanyDetail;

class CompanyProfileController extends Controller
{
    public function show(CompanyProfile $companyProfile)
    {
        $companyProfile = CompanyProfile::first();
        return new CompanyProfileResource($companyProfile,  'fetchdata', Response::HTTP_OK, 'Company Profile retrieved successfully.');
    }


    public function update(Request $request, $id)
    {
        $companyProfile = CompanyProfile::find($id);
        $companyProfile->update($request->all());
        return new CompanyProfileResource($companyProfile, 'update', Response::HTTP_OK, 'Company Profile updated successfully.');
    }

    public function store_detail($id)
    {
        $detail = CompanyDetail::where('company_id', $id)->get();
        return new CompanyProfileResource($detail, 'fetchdata', Response::HTTP_OK, 'Company Profile retrieved successfully.');
    }

    public function detail($id)
    {
        $detail = CompanyDetail::where('company_id', $id)->get();
        return new CompanyProfileResource($detail, 'fetchdata', Response::HTTP_OK, 'Company Profile retrieved successfully.');
    }
}
