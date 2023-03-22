<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace App\Models\Master;

use App\Models\Master\CompanyProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $table = 'company_details';

    protected $fillable = [
        'company_id',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'address',
        'phone',
        'email',
    ];

    public function company()
    {
        return $this->belongsTo(CompanyProfile::class);
    }
}
