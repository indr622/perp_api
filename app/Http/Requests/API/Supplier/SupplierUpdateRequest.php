<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:SupplierupdateRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class SupplierUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name'          => 'required|string|max:50',
            'email'         => 'required|email',
            'phone'         => 'required|numeric',
            'term_payment_id'       => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Supplier name is required.',
            'name.string'       => 'Supplier name must be a string.',
            'name.max'          => 'Supplier name must be less than 50 characters.',

            'email.required'    => 'Supplier email is required.',
            'email.email'       => 'Supplier email must be a valid email address.',

            'phone.required'    => 'Supplier phone is required.',
            'phone.numeric'     => 'Supplier phone must be a number.',

            'term_payment_id.required'  => 'Supplier term payment is required.',
            'term_payment_id.integer'   => 'Supplier term payment must be a string.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'update',
                'message'       => 'Supplier data failed to update.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
