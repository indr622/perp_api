<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('name', 'like', '%' . $request->get('keyword') . '%')
            ->orWhere('email', 'like', '%' . $request->get('keyword') . '%')
            ->orWhere('phone', 'like', '%' . $request->get('keyword') . '%')
            ->orWhere('address', 'like', '%' . $request->get('keyword') . '%');
    }

    public function term_payment()
    {
        return $this->belongsTo(TermPayment::class, 'term_payment_id');
    }
}
