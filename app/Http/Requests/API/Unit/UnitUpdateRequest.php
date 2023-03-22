<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   UnitUpdateRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Unit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class UnitUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              => 'required|string|max:50',
            'description'       => 'string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Unit name is required.',
            'name.string'       => 'Unit name must be a string.',
            'name.max'          => 'Unit name must be less than 50 characters.',

            'description.string' => 'Unit description must be a string.',
            'description.max'   => 'Unit description must be less than 100 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'update',
                'message'       => 'Units data failed to update.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
