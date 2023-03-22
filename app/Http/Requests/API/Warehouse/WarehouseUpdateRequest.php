<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:  WarehouseUpdateRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Warehouse;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class WarehouseUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'      => 'required|string|max:50',
            'email'     => 'required|email',
            'phone'     => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Warehouse name is required.',
            'name.string'       => 'Warehouse name must be a string.',
            'name.max'          => 'Warehouse name must be less than 50 characters.',

            'email.required'    => 'Warehouse email is required.',
            'email.email'       => 'Warehouse email must be a valid email address.',

            'phone.required'    => 'Warehouse phone is required.',
            'phone.numeric'     => 'Warehouse phone must be a number.',
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
