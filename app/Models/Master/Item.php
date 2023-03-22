<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace App\Models\Master;

use App\Models\Master\Unit;
use App\Models\Master\Group;
use App\Models\Master\SubGroup;
use App\Models\Master\ItemStyle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $guarded = [];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subgroup()
    {
        return $this->belongsTo(SubGroup::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function itemStyles()
    {
        return $this->hasMany(ItemStyle::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }
}
