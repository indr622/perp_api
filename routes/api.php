<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Master\PphController;
use App\Http\Controllers\Master\VatController;
use App\Http\Controllers\Master\ItemController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\UnitController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\GroupController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\CurrencyController;
use App\Http\Controllers\Master\CustomerController;
use App\Http\Controllers\Master\RetailerController;
use App\Http\Controllers\Master\SubGroupController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Master\TypeItemController;
use App\Http\Controllers\Order\QuotationController;
use App\Http\Controllers\Master\TypeInOutController;
use App\Http\Controllers\Master\TypeOrderController;
use App\Http\Controllers\Master\WarehouseController;
use App\Http\Controllers\Order\SalesOrderController;
use App\Http\Controllers\PDF\QuotationPdfController;
use App\Http\Controllers\Master\PermissionController;
use App\Http\Controllers\PDF\SalesOrderPdfController;
use App\Http\Controllers\Master\TermPaymentController;
use App\Http\Controllers\Widget\SalesWidgetController;
use App\Http\Controllers\Master\TermShippingController;
use App\Http\Controllers\Master\PaymentMethodController;
use App\Http\Controllers\PDF\PurchaseOrderPdfController;
use App\Http\Controllers\System\ConfigurationController;
use App\Http\Controllers\Master\CompanyProfileController;
use App\Http\Controllers\Master\ProductionStepController;
use App\Http\Controllers\Widget\PurchaseWidgetController;
use App\Http\Controllers\Purchase\PurchaseOrderController;
use App\Http\Controllers\PDF\PurchaseShippingPdfController;
use App\Http\Controllers\PDF\SalesInvoicePdfController;
use App\Http\Controllers\Purchase\PurchaseShippingController;
use App\Http\Controllers\Sales\SalesInvoiceController;
use App\Http\Controllers\System\NotificationController;
use App\Http\Controllers\Widget\DashboardWidgetController;
use App\Http\Controllers\Widget\PurchaseShippingWidgetController;
use App\Http\Controllers\Widget\QuotationWidgetController;
use App\Http\Controllers\Widget\SalesInvoiceWidgetController;
use App\Http\Controllers\Widget\SalesOrderWidgetController;

//Authentication
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::put('update-password/{id}', [AuthController::class, 'updatePassword']);
    Route::put('update/{id}', [AuthController::class, 'update']);
});

Route::middleware('auth:api')->group(function () {
    //Me Profile
    Route::get('auth/me', [AuthController::class, 'me']);
    //dashboard
    Route::get('dashboard/summary',  DashboardWidgetController::class);
    //Master Resource
    Route::apiResource('user',  UserController::class);
    Route::apiResource('role',  RoleController::class);
    Route::get('role/{id}/permissions', [RoleController::class, 'rolepermissions']);
    Route::post('set-role-permissions', [RoleController::class, 'setRolePermission']);
    Route::get('permissions',  PermissionController::class);
    Route::apiResource('groups',  GroupController::class);
    Route::apiResource('subgroups',  SubGroupController::class);
    Route::apiResource('warehouse',  WarehouseController::class);
    Route::apiResource('units',  UnitController::class);
    Route::apiResource('pph',  PphController::class);
    Route::apiResource('type-order',  TypeOrderController::class);
    Route::apiResource('type-in-out',  TypeInOutController::class);
    Route::apiResource('type-item',  TypeItemController::class);
    Route::apiResource('retailer',  RetailerController::class);
    Route::apiResource('production-step',  ProductionStepController::class);
    Route::apiResource('vat',  VatController::class);
    Route::apiResource('payment_method',  PaymentMethodController::class);
    Route::apiResource('supplier',  SupplierController::class);
    Route::apiResource('term-shipping',  TermShippingController::class);
    Route::apiResource('term-payment',  TermPaymentController::class);
    Route::apiResource('currency',  CurrencyController::class);
    Route::apiResource('customer',  CustomerController::class);
    Route::apiResource('item',  ItemController::class);
    Route::apiResource('product',  ProductController::class);
    Route::get('company-profile/{id}', [CompanyProfileController::class, 'show']);
    Route::get('company-profile/detail/{id}', [CompanyProfileController::class, 'detail']);
    Route::put('company-profile/{id}', [CompanyProfileController::class, 'update']);
    Route::apiResource('notification',  NotificationController::class);

    Route::prefix('quotation')->group(function () {
        Route::get('/widget', QuotationWidgetController::class);
        Route::get('/', [QuotationController::class, 'index']);
        Route::get('/{id}', [QuotationController::class, 'show']);
        Route::post('/', [QuotationController::class, 'store']);
        Route::put('/{id}', [QuotationController::class, 'update']);
    });

    Route::prefix('sales-order')->group(function () {
        Route::get('/widget', SalesOrderWidgetController::class);
        Route::get('/', [SalesOrderController::class, 'index']);
        Route::get('/list', [SalesOrderController::class, 'list']);
        Route::get('/{id}', [SalesOrderController::class, 'show']);
        Route::post('/', [SalesOrderController::class, 'store']);
        Route::put('/{id}', [SalesOrderController::class, 'update']);
    });

    Route::prefix('purchase-order')->group(function () {
        Route::get('/widget', PurchaseWidgetController::class);
        Route::get('/', [PurchaseOrderController::class, 'index']);
        Route::get('/balance', [PurchaseOrderController::class, 'balance']);
        Route::get('/{id}', [PurchaseOrderController::class, 'show']);
        Route::post('/', [PurchaseOrderController::class, 'store']);
        Route::put('/{id}', [PurchaseOrderController::class, 'update']);
    });

    Route::prefix('purchase-shipping')->group(function () {
        Route::get('/widget', PurchaseShippingWidgetController::class);
        Route::get('/', [PurchaseShippingController::class, 'index']);
        Route::get('/{id}', [PurchaseShippingController::class, 'show']);
        Route::post('/', [PurchaseShippingController::class, 'store']);
        Route::put('/{id}', [PurchaseShippingController::class, 'update']);
    });

    Route::prefix('sales-invoice')->group(function () {
        Route::get('/widget', SalesInvoiceWidgetController::class);
        Route::get('/', [SalesInvoiceController::class, 'index']);
        Route::get('/{id}', [SalesInvoiceController::class, 'show']);
        Route::post('/', [SalesInvoiceController::class, 'store']);
        Route::put('/{id}', [SalesInvoiceController::class, 'update']);
    });


    Route::prefix('/system/configuration')->group(function () {
        Route::get('/', [ConfigurationController::class, 'index']);

        Route::get('/generate', function () {
            Artisan::call("apikey:generate accounting-key");
            return response()->json(['message' => 'Success']);
        });

        Route::get('/accounting-key', function () {
            $key = DB::table('api_keys')->where('name', 'accounting-key')->first();
            return response()->json(['key' => $key->key]);
        });
    });
});

Route::middleware('auth.apikey')->group(function () {
    Route::prefix('accounting')->group(function () {
        Route::get('/customer', [CustomerController::class, 'index']);
    });
});

// PDF
Route::get('/sales_order/view/{id}', SalesOrderPdfController::class);
Route::get('/quotation/view/{id}', QuotationPdfController::class);
Route::get('/purchase-order/view/{id}', PurchaseOrderPdfController::class);
Route::get('/purchase-shipping/view/{id}', PurchaseShippingPdfController::class);
Route::get('/sales-invoice/view/{id}', SalesInvoicePdfController::class);
