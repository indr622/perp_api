<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2023-01-20
 */


namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermShipping extends Model
{
    use HasFactory;

    protected $table = 'term_shippings';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }
}
