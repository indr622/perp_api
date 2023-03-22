<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SalesOrderPdfController.php
 * Date: 2023-01-04
 */

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order\SalesOrder;
use App\Http\Controllers\Controller;
use App\Models\Master\CompanyProfile;
use App\Repository\order\SalesOrderRepository;

class SalesOrderPdfController extends Controller
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
        $salesOrderRepositroy = new SalesOrderRepository();
        $sales_order = $salesOrderRepositroy->findOne($id);

        return Pdf::loadView('pdf.sales_order', ['data' => $sales_order, 'template' =>  $template])->stream();
    }
}
