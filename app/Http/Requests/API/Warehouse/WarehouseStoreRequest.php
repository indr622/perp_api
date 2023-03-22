<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   WarehouseStoreRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Warehouse;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class WarehouseStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50|unique:warehouses,name',
            'email' => 'required|email|unique:warehouses,email',
            'phone' => 'required|numeric|unique:warehouses,phone',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Warehouse name is required.',
            'name.string'       => 'Warehouse name must be a string.',
            'name.max'          => 'Warehouse name must be less than 50 characters.',
            'name.unique'       => 'Warehouse name has already been taken.',

            'email.required'    => 'Warehouse email is required.',
            'email.email'       => 'Warehouse email must be a valid email address.',
            'email.unique'      => 'Warehouse email has already been taken.',

            'phone.required'    => 'Warehouse phone is required.',
            'phone.numeric'     => 'Warehouse phone must be a number.',
            'phone.unique'      => 'Warehouse phone has already been taken.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'store',
                'message'       => 'Warehouse data failed to store.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
