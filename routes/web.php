<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

use App\Http\Controllers\PDF\OrderStatusPdfController;
use App\Http\Controllers\PDF\QuotationPdfController;
use App\Http\Controllers\PDF\SalesOrderPdfController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return response()->json([
        'message' => 'P-ERP API',
        'version' => '1.0.0'
    ]);
});

Route::get('/example', function () {
    return view('example');
});
