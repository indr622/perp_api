<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:  CustomerUpdateRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => 'required|string|max:50',
            'email'         => 'required|string|email|max:50 ',
            'phone'         => 'required|string|numeric',
            'term_payment_id'       => 'required|integer',

        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Customer name is required.',
            'name.string'           => 'Customer name must be a string.',
            'name.max'              => 'Customer name must be less than 50 characters.',

            'email.required'        => 'Customer email is required.',
            'email.string'          => 'Customer email must be a string.',
            'email.email'           => 'Customer email must be a valid email address.',
            'email.max'             => 'Customer email must be less than 50 characters.',

            'phone.required'        => 'Customer phone is required.',
            'phone.string'          => 'Customer phone must be a string.',
            'phone.numeric'         => 'Customer phone must be a number.',

            'term_payment_id.required'  => 'Customer term payment is required.',
            'term_payment_id.integer'   => 'Customer term payment must be a string.',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'store',
                'message'       => 'Customer data failed to store.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
