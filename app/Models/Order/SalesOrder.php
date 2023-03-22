<?php

namespace App\Models\Order;

use App\Models\Master\Pph;
use App\Models\Master\Currency;
use App\Models\Master\Customer;
use App\Models\Master\Retailer;
use App\Models\Master\TermShipping;
use App\Models\Order\Quotation;
use App\Models\Master\TypeOrder;
use Illuminate\Support\Facades\DB;
use App\Models\Order\SalesOrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesOrder extends Model
{
    use HasFactory;

    protected $table = 'sales_orders';

    protected $guarded = [];

    public function scopeWhereDateBetween($query, $fromDate, $todate)
    {
        return $query->whereDate('so_order_date', '>=', $fromDate)->whereDate('so_order_date', '<=', $todate);
    }

    public function generateNewNumber()
    {
        $prefix = date('y/');

        $query = DB::table('sales_orders')->select(DB::raw('MAX(RIGHT(so_number,5)) as kd_max'));
        $prx = 'SO-' .  $prefix;
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

    public function term_shipping()
    {
        return $this->belongsTo(TermShipping::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class)
            ->select('id', 'name', 'symbol', 'is_active');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)
            ->select('id', 'name', 'address', 'phone', 'email', 'is_active');
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class)
            ->select('id', 'name', 'address', 'phone', 'email', 'is_active');
    }

    public function type_order()
    {
        return $this->belongsTo(TypeOrder::class, 'type_order_id', 'id')
            ->select('id', 'name', 'is_active');
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function sales_order_details()
    {
        return $this->hasMany(SalesOrderDetail::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('so_number', 'like', '%' . $search . '%')
            ->orWhere('customer_po', 'like', '%' . $search . '%');
    }
}
