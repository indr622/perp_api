<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   ProductStoreRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:50|unique:products,name',
            'retailer_id' => 'required|integer',
            'item_id' => 'required|integer',
            'thick' => 'required',
            'width' => 'required',
            'length' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Item Code is required.',
            'name.string'       => 'Item Code must be a string.',
            'name.max'          => 'Item Code must be less than 50 characters.',
            'name.unique'       => 'Item Code has already been taken.',

            'retailer_id.required' => 'Retailer is required.',
            'retailer_id.integer' => 'Retailer must be a number.',

            'item_id.required'  => 'Item is required.',
            'item_id.integer'   => 'Item must be a number.',

            'thick.required'    => 'Thick is required.',
            'width.required'    => 'Width is required.',
            'length.required'   => 'Length is required.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'pid' => 'store',
                'message' => 'Retailers data failed to store.',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
