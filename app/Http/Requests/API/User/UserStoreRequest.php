<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              => 'required|string|max:50',
            'username'          => 'required|string|max:50|unique:users,username',
            'email'             => 'required|string|email|max:50|unique:users,email',

        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'User name is required.',
            'name.string'       => 'User name must be a string.',
            'name.max'          => 'User name must be less than 50 characters.',

            'username.required'     => 'User username is required.',
            'username.string'       => 'User username must be a string.',
            'username.max'          => 'User username must be less than 50 characters.',
            'username.unique'       => 'User username has already been taken.',

            'email.required'     => 'User email is required.',
            'email.string'       => 'User email must be a string.',
            'email.max'          => 'User email must be less than 50 characters.',
            'email.unique'       => 'User email has already been taken.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'store',
                'message'       => 'Users data failed to store.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
