<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace App\Http\Requests\API\Retailer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class RetailerStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'      => 'required|string|max:50|unique:retailers,name',
            'address'   => 'required|string|max:255',
            'email'     => 'nullable|email|unique:retailers,email',
            'phone'     => 'unique:retailers,phone',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Retailer name is required.',
            'name.string' => 'Retailer name must be a string.',
            'name.max' => 'Retailer name must be less than 50 characters.',
            'name.unique' => 'Retailer name has already been taken.',
            'address.required' => 'Retailer address is required.',
            'address.string' => 'Retailer address must be a string.',
            'address.max' => 'Retailer address must be less than 255 characters.',
            'email.email' => 'Retailer email must be a valid email address.',
            'email.unique' => 'Retailer email has already been taken.',
            'phone.unique' => 'Retailer phone has already been taken.',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'pid' => 'store',
                'message' => 'Retailers data failed to store.',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
