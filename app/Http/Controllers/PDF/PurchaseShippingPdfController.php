<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PurchaseShippingPdfController.php
 * Date: 2023-01-25
 */

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use App\Models\Master\CompanyProfile;
use App\Repository\purchase\PurchaseShippingRepository;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseShippingPdfController extends Controller
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
        $purchaseShippingRepo = new PurchaseShippingRepository();
        $purchase_shipping = $purchaseShippingRepo->findOne($id);

        return Pdf::loadView('pdf.purchase_shipping', ['data' => $purchase_shipping, 'template' =>  $template])->stream();
    }
}
