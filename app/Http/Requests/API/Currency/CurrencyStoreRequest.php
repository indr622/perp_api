<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   CurrencyStoreRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Currency;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class CurrencyStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50|unique:currencies,name',
            'symbol' => 'required|string|max:50',

        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Currency name is required.',
            'name.string'           => 'Currency name must be a string.',
            'name.max'              => 'Currency name must be less than 50 characters.',
            'name.unique'           => 'Currency name already exists.',

            'symbol.required'       => 'Currency symbol is required.',
            'symbol.string'         => 'Currency symbol must be a string.',
            'symbol.max'            => 'Currency symbol must be less than 50 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'store',
                'message'       => 'Currency data failed to store.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
