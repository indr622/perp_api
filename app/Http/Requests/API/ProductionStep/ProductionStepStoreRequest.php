<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   ProductionStepStoreRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\ProductionStep;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductionStepStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:production_steps,name',
            'is_active'     => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Production Step name is required.',
            'name.string'           => 'Production Step name must be a string.',
            'name.unique'           => 'Production Step name has already been taken.',

            'is_active.required'    => 'Production Step status is required.',
            'is_active.boolean'     => 'Production Step status must be a boolean.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'pid' => 'store',
                'message' => 'Production Step data failed to store.',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
