<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   TypeInOutStoreRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\TypeInOut;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class TypeInOutStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'      => 'required|string|max:50|unique:type_in_outs,name',

        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Type In Out name is required.',
            'name.string'       => 'Type In Out name must be a string.',
            'name.max'          => 'Type In Out name must be less than 50 characters.',
            'name.unique'       => 'Type In Out name has already been taken.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'    => false,
                'pid'       => 'store',
                'message'   => 'Type In Out data failed to store.',
                'errors'    => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
