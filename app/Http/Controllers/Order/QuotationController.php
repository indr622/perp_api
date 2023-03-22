<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: QuotationController.php
 * Date: 2022-11-01
 */

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Quotation\QuotationStoreRequest;
use App\Http\Requests\API\Quotation\QuotationUpdateRequest;
use App\Repository\order\QuotationRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Order\QuotationResource;

class QuotationController extends Controller
{
    protected $quotationRepository;

    public function __construct(QuotationRepository $quotationRepository)
    {
        $this->quotationRepository = $quotationRepository;
    }

    public function index(Request $request)
    {
        $quotation = $this->quotationRepository->findAll($request);
        return new QuotationResource($quotation,  'fetchdata', Response::HTTP_CREATED, 'Quotation retrieved successfully.');
    }

    public function store(QuotationStoreRequest $request)
    {
        $quotation = $this->quotationRepository->store($request);
        return new QuotationResource($quotation,  'store', Response::HTTP_CREATED, 'Quotation created successfully.');
    }


    public function show($id)
    {
        $quotation = $this->quotationRepository->findOne($id);
        if (!$quotation) {
            return new QuotationResource(null,  'fetchdata', Response::HTTP_OK, 'Quotation Order not found');
        }
        return new QuotationResource($quotation,  'fetchdata', Response::HTTP_OK, 'Quotation retrieved successfully.');
    }


    public function update(QuotationUpdateRequest $request, $id)
    {
        $quotation = $this->quotationRepository->update($request, $id);
        return new QuotationResource($quotation,  'update', Response::HTTP_CREATED, 'Quotation updated successfully.');
    }
}
