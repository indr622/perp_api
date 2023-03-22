<?php

namespace App\Http\Requests\API\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class PurchaseOrderStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'supplier_id'       => 'required|integer',
            'currency_id'       => 'required|integer',
            'pph_id'            => 'required|integer',
            'shipping_name'     => 'required',
            'order_date'        => 'required',
            'request_date'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'supplier_id.required'      => 'Supplier is required.',
            'supplier_id.integer'       => 'Supplier must be integer.',
            'currency_id.required'      => 'Currency is required.',
            'currency_id.integer'       => 'Currency must be integer.',
            'pph_id.required'           => 'PPH is required.',
            'pph_id.integer'            => 'PPH must be integer.',
            'order_date.required'       => 'Order date is required.',
            'order_date.date'           => 'Order date must be date.',
            'request_date.required'     => 'Request date is required.',
            'request_date.date'         => 'Request date must be date.',
            'shipping_name.required'    => 'Shipping is required.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'store',
                'message'       => 'Purchase Order data failed to store.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
