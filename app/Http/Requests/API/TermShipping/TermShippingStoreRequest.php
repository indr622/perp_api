<?php

namespace App\Http\Requests\API\TermShipping;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class TermShippingStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => 'required|string|max:50|unique:term_shippings,name',
            'description'   => 'string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Term Shipping name is required.',
            'name.string'       => 'Term Shipping name must be a string.',
            'name.max'          => 'Term Shipping name must be less than 50 characters.',
            'name.unique'       => 'Term Shipping name has already been taken.',

            'description.string' => 'Term Shipping description must be a string.',
            'description.max'    => 'Term Shipping description must be less than 100 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'    => false,
                'pid'       => 'store',
                'message'   => 'Term Shipping data failed to store.',
                'errors'    => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
