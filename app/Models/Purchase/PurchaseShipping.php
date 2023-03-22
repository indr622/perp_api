<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PurchaseShipping.php
 * Date: 2023-01-30
 */

namespace App\Models\Purchase;

use App\Models\Master\Pph;
use App\Models\Master\Currency;
use App\Models\Master\Supplier;
use App\Models\Master\TermPayment;
use Illuminate\Support\Facades\DB;
use App\Models\Master\TermShipping;
use App\Models\Purchase\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase\PurchaseShippingDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseShipping extends Model
{
    use HasFactory;

    protected $table = 'purchase_shippings';

    protected $guarded = [];

    public function generateNewNumber()
    {
        $prefix = date('y/');

        $query = DB::table('purchase_shippings')->select(DB::raw('MAX(RIGHT(shp_number,5)) as kd_max'));
        $prx = 'SHP-' .  $prefix;
        if ($query->count() > 0) {
            foreach ($query->get() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = $prx . sprintf("%06s", $tmp);
            }
        } else {
            $kd = $prx . "000001";
        }
        return $kd;
    }
    public function scopeWhereDateBetween($query, $fromDate, $todate)
    {
        return $query->whereDate('ps_request_date', '>=', $fromDate)->whereDate('ps_request_date', '<=', $todate);
    }

    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function purchase_shipping_details()
    {
        return $this->hasMany(PurchaseShippingDetail::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    public function pph()
    {
        return $this->belongsTo(Pph::class);
    }

    public function term_shipping()
    {
        return $this->belongsTo(TermShipping::class);
    }

    public function term_payment()
    {
        return $this->belongsTo(TermPayment::class);
    }
}
