<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   SubGroupUpdateRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\SubGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class SubGroupUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:50 ',
            'description' => 'string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Subgroup name is required.',
            'name.string'       => 'Subgroup name must be a string.',
            'name.max'          => 'Subgroup name must be less than 50 characters.',

            'description.string' => 'Subgroup description must be a string.',
            'description.max'   => 'Subgroup description must be less than 100 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'pid' => 'update',
                'message' => 'Subgroup data failed to update.',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
