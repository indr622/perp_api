<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: SalesInvoice.php
 * Date: 2023-02-13
 */

namespace App\Models\Sales;

use App\Models\Master\Customer;
use App\Models\Order\SalesOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales\SalesInvoiceDetail;
use App\Models\Purchase\PurchaseShipping;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesInvoice extends Model
{
    use HasFactory;

    protected $table = 'sales_invoices';

    protected $guarded = [];
    public function generateNewNumber()
    {
        $prefix = date('y/');

        $query = DB::table('sales_invoices')->select(DB::raw('MAX(RIGHT(inv_number,5)) as kd_max'));
        $prx = 'INV-' .  $prefix;
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
    public function sales_invoice_details()
    {
        return $this->hasMany(SalesInvoiceDetail::class);
    }

    public function sales_order()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function purchase_shipping()
    {
        return $this->belongsTo(PurchaseShipping::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
