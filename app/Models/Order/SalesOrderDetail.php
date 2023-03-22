<?php

namespace App\Models\Order;

use App\Models\Master\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'sales_order_details';

    protected $guarded = [];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getAmountAttribute()
    {
        return $this->qty * $this->price;
    }

    public function getSubtotalAttribute()
    {
        return $this->qty * $this->price;
    }

    public function getDiscountAttribute()
    {
        return $this->salesOrder->discount_nominal;
    }

    public function getPphAttribute()
    {
        return $this->salesOrder->pph;
    }

    public function getVatAttribute()
    {
        return $this->salesOrder->vat;
    }

    public function getTotalAmountAttribute()
    {
        return $this->subtotal - $this->discount + $this->pph + $this->vat;
    }

    public function getSubtotalAmountAttribute()
    {
        return $this->subtotal - $this->discount;
    }

    public function getGrandTotalAttribute()
    {
        return $this->subtotal - $this->discount + $this->pph + $this->vat;
    }

    public function getGrandTotalAmountAttribute()
    {
        return $this->subtotal - $this->discount + $this->pph + $this->vat;
    }
}
