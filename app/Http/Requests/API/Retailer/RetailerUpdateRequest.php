<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace App\Http\Requests\API\Retailer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class RetailerUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => 'required|string|max:50',
            'address'       => 'required|string|max:255',
            'email'         => 'nullable|email',

        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Retailer name is required.',
            'name.string'       => 'Retailer name must be a string.',
            'name.max'          => 'Retailer name must be less than 50 characters.',
            'address.required'  => 'Retailer address is required.',
            'address.string'    => 'Retailer address must be a string.',
            'address.max'       => 'Retailer address must be less than 255 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'update',
                'message'       => 'Retailers data failed to update.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
