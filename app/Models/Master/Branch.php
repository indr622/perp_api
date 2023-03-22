<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace App\Models\Master;

use App\Models\Master\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'description',
        'is_active',
    ];

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%")
            ->orWhere('address', 'like', "%$search%")
            ->orWhere('phone', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%");
    }

    public function scopeSort($query, $sort)
    {
        return $query->orderBy($sort['column'], $sort['direction']);
    }

    public function scopePaginate($query, $paginate)
    {
        return $query->paginate($paginate['per_page'], ['*'], 'page', $paginate['page']);
    }

    public function scopeGetAll($query)
    {
        return $query->get();
    }
}
