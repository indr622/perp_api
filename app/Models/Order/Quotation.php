<?php

namespace App\Models\Order;

use App\Models\Master\Pph;
use App\Models\Master\Currency;
use App\Models\Master\Customer;
use App\Models\Master\Retailer;
use App\Models\Master\TypeOrder;
use Illuminate\Support\Facades\DB;
use App\Models\Master\TermShipping;
use App\Models\Order\QuotationDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;

    protected $table = 'quotations';

    protected $guarded = [];

    protected $casts = [
        'created_at' =>  'date:m-d-Y',
    ];

    public function generateNewNumber()
    {
        $prefix = date('y/');

        $query = DB::table('quotations')->select(DB::raw('MAX(RIGHT(quo_number,6)) as kd_max'));
        $prx = 'QUO-' .  $prefix;
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

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function type_order()
    {
        return $this->belongsTo(TypeOrder::class, 'type_order_id', 'id');
    }

    public function term_shipping()
    {
        return $this->belongsTo(TermShipping::class);
    }

    public function quotation_details()
    {
        return $this->hasMany(QuotationDetail::class);
    }
}
