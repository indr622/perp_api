<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PurchaseShippingDetail.php
 * Date: 2023-01-30
 */

namespace App\Models\Purchase;

use App\Models\Master\Item;
use App\Models\Master\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase\PurchaseShipping;
use App\Models\Purchase\PurchaseOrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseShippingDetail extends Model
{
    use HasFactory;

    protected $table = 'purchase_shipping_details';

    protected $guarded = [];

    public function purchase_shipping()
    {
        return $this->belongsTo(PurchaseShipping::class);
    }

    public function purchase_order_detail()
    {
        return $this->belongsTo(PurchaseOrderDetail::class);
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
