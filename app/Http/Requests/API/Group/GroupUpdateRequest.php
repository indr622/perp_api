<?php

namespace App\Http\Requests\API\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class GroupUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'description' => 'string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Group name is required.',
            'name.string'       => 'Group name must be a string.',
            'name.max'          => 'Group name must be less than 50 characters.',

            'description.string' => 'Group description must be a string.',
            'description.max'    => 'Group description must be less than 100 characters.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'pid' => 'update',
                'message' => 'Group data failed to update.',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
