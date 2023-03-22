<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: QuotationUpdateRequest.php
 * Date: 2022-02-02
 */

namespace App\Http\Requests\API\Quotation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuotationUpdateRequest extends FormRequest
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
            // 'quo_order_date'        => 'required|date',
            // 'quo_request_date'      => 'required|date',
            // 'quo_shipping_address'  => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required'      => 'Customer is required.',
            'customer_id.integer'       => 'Customer must be an integer.',
            'retailer_id.required'      => 'Retailer is required.',
            'retailer_id.integer'       => 'Retailer must be an integer.',
            'currency_id.required'      => 'Currency is required.',
            'currency_id.integer'       => 'Currency must be an integer.',
            'type_order_id.required'    => 'Type Order is required.',
            'type_order_id.integer'     => 'Type Order must be an integer.',
            'pph_id.required'           => 'PPH is required.',
            'pph_id.integer'            => 'PPH must be an integer.',
            'order_date.required'       => 'Order Date is required.',
            'order_date.date'           => 'Order Date must be a date.',
            'request_date.required'     => 'Request Date is required.',
            'request_date.date'         => 'Request Date must be a date.',
            'shipping_address.required' => 'Shipping Address is required.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'UPDATE',
                'message'       => 'Quotation data failed to UPDATE.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
