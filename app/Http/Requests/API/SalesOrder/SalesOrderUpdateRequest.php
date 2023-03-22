<?php

namespace App\Http\Requests\API\SalesOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class SalesOrderUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer_id'           => 'required|integer',
            'retailer_id'           => 'required|integer',
            'currency_id'           => 'required|integer',
            'type_order_id'         => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'customer_id.required'          => 'Customer is required.',
            'customer_id.integer'           => 'Customer must be an integer.',
            'retailer_id.required'          => 'Retailer is required.',
            'retailer_id.integer'           => 'Retailer must be an integer.',
            'currency_id.required'          => 'Currency is required.',
            'currency_id.integer'           => 'Currency must be an integer.',
            'type_order_id.required'        => 'Type Order is required.',
            'type_order_id.integer'         => 'Type Order must be an integer.',
            'so_order_date.required'        => 'Order Date is required.',
            'so_order_date.date'            => 'Order Date must be a date.',
            'so_request_date.required'      => 'Request Date is required.',
            'so_request_date.date'          => 'Request Date must be a date.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'update',
                'message'       => 'Sales Order data failed to update.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
