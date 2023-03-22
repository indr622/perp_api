<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: OrderStatusPdfController.php
 * Date: 2023-01-04
 */

namespace App\Http\Controllers\PDF;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderStatusPdfController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $data = [
            'title' => 'Quotation',
            'content' => 'This is my first PDF file.'
        ];
        return Pdf::loadView('pdf.quotation', $data)->stream();
    }
}
