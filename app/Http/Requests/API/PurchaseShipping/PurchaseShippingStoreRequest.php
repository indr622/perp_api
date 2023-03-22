<?php

namespace App\Http\Requests\API\PurchaseShipping;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class PurchaseShippingStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'purchase_order_id'         => 'required|integer',
            'request_date'              => 'required',
        ];
    }

    public function messages()
    {
        return [
            'purchase_order_id.required'        => 'Purchase Order is required.',
            'purchase_order_id.integer'         => 'Purchase Order must be an integer.',
            'shp_request_date.required'         => 'Shipping Request Date is required.',
            'shp_request_date.date'             => 'Shipping Request Date must be a date.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'store',
                'message'       => 'Purchase Shipping data failed to store.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
