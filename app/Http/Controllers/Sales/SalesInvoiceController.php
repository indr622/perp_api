<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SalesInvoiceController.php
 * Date: 2023-02-13
 */

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\sales\SalesInvoiceRepository;
use App\Http\Requests\API\SalesInvoice\SalesInvoiceStoreRequest;
use App\Http\Requests\API\SalesInvoice\SalesInvoiceUpdateRequest;
use App\Http\Resources\Sales\SalesInvoiceResource;

class SalesInvoiceController extends Controller
{

    protected $salesInvoiceRepository;

    public function __construct(SalesInvoiceRepository $salesInvoiceRepository)
    {
        $this->salesInvoiceRepository = $salesInvoiceRepository;
    }

    public function index(Request $request)
    {
        $sales_invoice = $this->salesInvoiceRepository->findAll($request);
        return new SalesInvoiceResource($sales_invoice,  'fetchdata', Response::HTTP_CREATED, 'Sales Invoice  retrieved successfully.');
    }


    public function store(SalesInvoiceStoreRequest $request)
    {
        $sales_invoice = $this->salesInvoiceRepository->store($request);
        return new SalesInvoiceResource($sales_invoice,  'store', Response::HTTP_CREATED, 'Sales Invoice created successfully.');
    }

    public function show($id)
    {
        $sales_invoice = $this->salesInvoiceRepository->findOne($id);
        return new SalesInvoiceResource($sales_invoice,  'fetchdata', Response::HTTP_CREATED, 'Sales Invoice  retrieved successfully.');
    }

    public function update(SalesInvoiceUpdateRequest $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
