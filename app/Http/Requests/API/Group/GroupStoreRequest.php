<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   GroupStoreRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class GroupStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50|unique:groups,name',
            'description' => 'string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Group name is required.',
            'name.string'       => 'Group name must be a string.',
            'name.max'          => 'Group name must be less than 50 characters.',
            'name.unique'       => 'Group name already exists.',

            'description.string' => 'Group description must be a string.',
            'description.max'    => 'Group description must be less than 100 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'pid' => 'store',
                'message' => 'Group data failed to store.',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
