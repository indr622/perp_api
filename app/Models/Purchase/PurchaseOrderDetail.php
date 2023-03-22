<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PurchaseOrderDetail.php
 * Date: 2023-01-30
 */

namespace App\Models\Purchase;

use App\Models\Master\Item;
use App\Models\Master\Product;
use App\Models\Order\SalesOrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'purchase_order_details';

    protected $fillable = [
        'purchase_order_id',
        'sales_order_detail_id',
        'product_id',
        'item_id',
        'price_buy',
        'qty',
        'balance',
        'remark',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function purchase_shipping_detail()
    {
        return $this->hasOne(PurchaseShippingDetail::class);
    }

    public function sales_order_detail()
    {
        return $this->belongsTo(SalesOrderDetail::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
