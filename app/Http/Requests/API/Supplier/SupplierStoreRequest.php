<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:SupplierStoreRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class SupplierStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name'                  => 'required|string|max:50|unique:suppliers,name',
            'email'                 => 'required|email|unique:suppliers,email',
            'phone'                 => 'required|numeric|unique:suppliers,phone',
            'term_payment_id'       => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Supplier name is required.',
            'name.string'       => 'Supplier name must be a string.',
            'name.max'          => 'Supplier name must be less than 50 characters.',
            'name.unique'       => 'Supplier name has already been taken.',

            'email.required'    => 'Supplier email is required.',
            'email.email'       => 'Supplier email must be a valid email address.',
            'email.unique'      => 'Supplier email has already been taken.',

            'phone.required'    => 'Supplier phone is required.',
            'phone.numeric'     => 'Supplier phone must be a number.',
            'phone.unique'      => 'Supplier phone has already been taken.',

            'term_payment_id.required'  => 'Supplier term payment is required.',
            'term_payment_id.integer'   => 'Supplier term payment must be a string.',

        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'store',
                'message'       => 'Supplier data failed to store.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
