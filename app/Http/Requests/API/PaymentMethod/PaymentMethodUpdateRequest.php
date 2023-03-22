<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   PaymentMethodUpdateRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaymentMethodUpdateRequest extends FormRequest
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
            'name.required' => 'Payment Method name is required.',
            'name.string' => 'Payment Method name must be a string.',
            'name.max' => 'Payment Method name must be less than 50 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'update',
                'message'       => 'Payment Method data failed to update.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
