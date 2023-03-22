<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SalesInvoicePdfController.php
 * Date: 2023-02-13
 */

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Repository\sales\SalesInvoiceRepository;

class SalesInvoicePdfController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $template = asset('image/gmk_logo.png');
        $image = 'image/gmk_logo.png';
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $template = $dataUri;
        $salesInvoiceRepository = new SalesInvoiceRepository();
        $sales_invoice = $salesInvoiceRepository->findOne($id);
        return Pdf::loadView('pdf.sales_invoice', ['data' => $sales_invoice, 'template' =>  $template])->stream();
    }
}
