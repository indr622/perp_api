<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\Master\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'name' => 'inch',
            'description' => 'inch',
            'is_active' => true,
        ]);

        Unit::create([
            'name' => 'cm',
            'description' => 'Centimetre',
            'is_active' => true,
        ]);

        Unit::create([
            'name' => 'mm',
            'description' => 'Millimetre',
            'is_active' => true,
        ]);

        Unit::create([
            'name' => 'm',
            'description' => 'Metre',
            'is_active' => true,
        ]);

        Unit::create([
            'name' => 'pcs',
            'description' => 'Piece',
            'is_active' => true,
        ]);

        Unit::create([
            'name' => 'kg',
            'description' => 'Kilogram',
            'is_active' => true,
        ]);

        Unit::create([
            'name' => 'g',
            'description' => 'Gram',
            'is_active' => true,
        ]);

        Unit::create([
            'name' => 'mg',
            'description' => 'Milligram',
            'is_active' => true,
        ]);
    }
}
