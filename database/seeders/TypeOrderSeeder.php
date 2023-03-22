<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\Master\TypeOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeOrder::create([
            'name' => 'Sales',
            'is_active' => true,
        ]);

        TypeOrder::create([
            'name' => 'Offline',
            'is_active' => true,
        ]);

        TypeOrder::create([
            'name' => 'B2B',
            'is_active' => true,
        ]);

        // TypeOrder::create([
        //     'name' => 'Sales 2',
        //     'is_active' => false,
        // ]);

        // TypeOrder::create([
        //     'name' => 'Purchase 2',
        //     'is_active' => false,
        // ]);

        // TypeOrder::create([
        //     'name' => 'Maintenance 2',
        //     'is_active' => false,
        // ]);
    }
}
