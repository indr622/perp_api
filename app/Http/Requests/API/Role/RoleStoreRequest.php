<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   RoleStoreRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoleStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50|unique:roles,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Role name is required.',
            'name.string'       => 'Role name must be a string.',
            'name.max'          => 'Role name must be less than 50 characters.',
            'name.unique'       => 'Role name has already been taken.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'store',
                'message'       => 'Role data failed to store.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
