<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: PurchaseOrder.php
 * Date: 2023-01-30
 */

namespace App\Models\Purchase;

use App\Models\Master\Pph;
use App\Models\Master\Currency;
use App\Models\Master\Supplier;
use App\Models\Master\TermPayment;
use Illuminate\Support\Facades\DB;
use App\Models\Master\TermShipping;
use App\Models\Order\SalesOrder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase\PurchaseOrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase_orders';

    protected $guarded = [];

    public function generateNewNumber()
    {
        $prefix = date('y/');

        $query = DB::table('purchase_orders')->select(DB::raw('MAX(RIGHT(po_number,5)) as kd_max'));
        $prx = 'PO-' .  $prefix;
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
        return $query->whereDate('po_order_date', '>=', $fromDate)->whereDate('po_order_date', '<=', $todate);
    }

    public function sales_order()
    {
        return $this->belongsTo(SalesOrder::class, 'sales_order_id', 'id');
    }

    public function purchase_order_details()
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
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


    public function scopeSearch($query, $search)
    {
        return $query->where('po_number', 'like', '%' . $search . '%')
            ->orWhere('po_date', 'like', '%' . $search . '%')
            ->orWhere('po_due_date', 'like', '%' . $search . '%')
            ->orWhere('po_remark', 'like', '%' . $search . '%');
    }

    public function scopeDateBetween($query, $dateFrom, $dateTo)
    {
        return $query->whereBetween('po_date', [$dateFrom, $dateTo]);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('po_status', $status);
    }

    public function scopeType($query, $type)
    {
        return $query->where('po_type', $type);
    }

    public function scopeSupplier($query, $supplier)
    {
        return $query->where('supplier_id', $supplier);
    }

    public function scopeCurrency($query, $currency)
    {
        return $query->where('currency_id', $currency);
    }

    public function scopeTermPayment($query, $termPayment)
    {
        return $query->where('term_payment_id', $termPayment);
    }

    public function scopeTermShipping($query, $termShipping)
    {
        return $query->where('term_shipping_id', $termShipping);
    }
}
