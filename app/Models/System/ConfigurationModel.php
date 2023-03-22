<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2023-01-12
 */

namespace App\Models\System;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConfigurationModel extends Model
{
    use HasFactory;
    /**
     * tabel name
     *
     * @var string
     */
    protected $table = 'configurations';
    /**
     * primary key
     *
     * @var string
     */
    protected $primaryKey = 'config_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'config_group', 'config_group', 'config_key', 'config_value'
    ];
    /**
     * enable auto_increment.
     *
     * @var string
     */
    public $incrementing = false;
    /**
     * activated timestamps.
     *
     * @var string
     */
    public $timestamps = true;

    //store ke cache
    public static function toCache()
    {
        $config = ConfigurationModel::all()->pluck('config_value', 'config_key');
        Cache::put('config', $config);
    }
    public static function getCache($idx = null)
    {
        if (!Cache::has('config')) {
            ConfigurationModel::toCache();
        }

        if ($idx == null) {
            return Cache::get('config');
        } else {
            $config = Cache::get('config');
            return $config[$idx];
        }
    }
    //clear cache
    public static function clear()
    {
        Cache::flush();
    }
}
