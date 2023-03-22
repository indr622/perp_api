<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file:   ItemStoreRequest.php
 * Date: 2022-12-29
 */

namespace App\Http\Requests\API\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subgroup_id'           => 'required|numeric',
            'unit_id'               => 'required|numeric',
            'name'                  => 'required|string|max:50|unique:items,name',
            'specification'         => 'nullable|max:125',
            'price_buy'             => 'required|numeric',
            'price_sell'            => 'required|numeric',
            'price_formula'         => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'subgroup_id.required'          => 'Item subgroup is required.',
            'subgroup_id.numeric'           => 'Item subgroup must be a number.',
            'unit_id.required'              => 'Item unit is required.',
            'unit_id.numeric'               => 'Item unit must be a number.',
            'name.required'                 => 'Item name is required.',
            'name.string'                   => 'Item name must be a string.',
            'name.max'                      => 'Item name must be less than 50 characters.',
            'name.unique'                   => 'Item name has already been taken.',

            'specification.max'             => 'Item specification must be less than 125 characters.',

            'price_buy.required'            => 'Item price buy is required.',
            'price_buy.numeric'             => 'Item price buy must be a number.',
            'price_buy.digits_between'      => 'Item price buy must be between 1 and 15 digits.',

            'price_sell.required'           => 'Item price sell is required.',
            'price_sell.numeric'            => 'Item price sell must be a number.',
            'price_sell.digits_between'     => 'Item price sell must be between 1 and 15 digits.',

            'price_formula.required'        => 'Item price formula is required.',
            'price_formula.numeric'         => 'Item price formula must be a number.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'store',
                'message'       => 'ITEM Method data failed to store.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
