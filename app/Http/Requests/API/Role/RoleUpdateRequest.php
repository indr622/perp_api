<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   RoleUpdateRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoleUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Role name is required.',
            'name.string'       => 'Role name must be a string.',
            'name.max'          => 'Role name must be less than 50 characters.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'update',
                'message'       => 'Role data failed to update.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
