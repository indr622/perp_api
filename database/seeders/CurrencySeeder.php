<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\Master\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'IDR',
            'description' => 'Indonesian Rupiah',
            'symbol' => 'Rp',
            'is_active' => true,
        ]);

        Currency::create([
            'name' => 'USD',
            'description' => 'United States Dollar',
            'symbol' => '$',
            'is_active' => true,
        ]);

        Currency::create([
            'name' => 'EUR',
            'description' => 'Euro',
            'symbol' => '€',
            'is_active' => true,
        ]);

        Currency::create([
            'name' => 'KRW',
            'description' => 'South Korean Won',
            'symbol' => '₩',
            'is_active' => true,
        ]);

        Currency::create([
            'name' => 'SGD',
            'description' => 'Singapore Dollar',
            'symbol' => 'S$',
            'is_active' => true,
        ]);
    }
}
