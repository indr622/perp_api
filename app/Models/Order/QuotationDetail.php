<?php

namespace App\Models\Order;

use App\Models\Master\Product;
use App\Models\Order\Quotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuotationDetail extends Model
{
    use HasFactory;

    protected $table = 'quotation_details';

    protected $guarded = [];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->price_sell * $this->qty;
    }
}
