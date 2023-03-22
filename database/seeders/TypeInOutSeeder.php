<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\Master\TypeInOut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeInOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeInOut::create([
            'name' => 'In',
            'flag' => 'IN',
            'is_active' => true,
        ]);

        TypeInOut::create([
            'name' => 'Out',
            'flag' => 'OUT',
            'is_active' => true,
        ]);
    }
}
