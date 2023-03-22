<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   PphStoreRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Pph;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class PphStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'percentage' => 'required|numeric|unique:pphs,percentage',
            'description' => 'string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'percentage.required'       => 'PPH percentage is required.',
            'percentage.numeric'        => 'PPH percentage must be a number.',
            'percentage.unique'         => 'PPH percentage has already been taken.',

            'description.string'        => 'PPH description must be a string.',
            'description.max'           => 'PPH description must be less than 100 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'pid' => 'store',
                'message' => 'PPH data failed to store.',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
