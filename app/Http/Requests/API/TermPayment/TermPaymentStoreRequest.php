<?php

namespace App\Http\Requests\API\TermPayment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class TermPaymentStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => 'required|string|max:50|unique:term_payments,name',
            'description'   => 'string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Term Payment name is required.',
            'name.string'       => 'Term Payment name must be a string.',
            'name.max'          => 'Term Payment name must be less than 50 characters.',
            'name.unique'       => 'Term Payment name has already been taken.',

            'description.string' => 'Term Payment description must be a string.',
            'description.max'    => 'Term Payment description must be less than 100 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'pid' => 'store',
                'message' => 'Term Payment data failed to store.',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
