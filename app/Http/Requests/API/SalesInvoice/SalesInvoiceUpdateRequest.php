<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SalesInvoiceUpdateRequest.php
 * Date: 2023-02-13
 */

namespace App\Http\Requests\API\SalesInvoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class SalesInvoiceUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'        => false,
                'pid'           => 'update',
                'message'       => 'Sales Invoice data failed to update.',
                'errors'        => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
