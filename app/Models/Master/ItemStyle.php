<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStyle extends Model
{
    use HasFactory;

    protected $table = 'item_styles';


    protected $fillable = [
        'item_id',
        'style_id',
        'created_by',
        'updated_by',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function style()
    {
        return $this->belongsTo(Style::class, 'style_id');
    }
}
