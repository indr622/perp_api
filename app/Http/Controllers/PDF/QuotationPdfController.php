<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: QuotationPdfController.php
 * Date: 2022-12-26
 */

namespace App\Http\Controllers\PDF;


use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Master\CompanyProfile;
use App\Repository\order\QuotationRepository;

class QuotationPdfController extends Controller
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
        $quotationRepository = new QuotationRepository();
        $quotation = $quotationRepository->findOne($id);
        return Pdf::loadView('pdf.quotation', ['data' => $quotation, 'template' =>  $template])->stream();
    }
}
