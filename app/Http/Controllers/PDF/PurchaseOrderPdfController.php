<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PurchaseOrderPdfController.php
 * Date: 2023-01-20
 */

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\CompanyProfile;
use App\Repository\purchase\PurchaseOrderRepository;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseOrderPdfController extends Controller
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
        $purchaseOrderRepository = new PurchaseOrderRepository();
        $purchase_order = $purchaseOrderRepository->findOne($id);

        //dd($purchase_order);
        return Pdf::loadView('pdf.purchase_order', ['data' => $purchase_order, 'template' =>  $template])->stream();
    }
}
