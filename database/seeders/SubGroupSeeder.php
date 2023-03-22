<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\Master\SubGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return SubGroup::create([
            'group_id' => 1,
            'name' => 'Plastik tebal',
            'description' => 'Barang Jadi',
            'is_active' => true
        ]);

        SubGroup::create([
            'group_id' => 1,
            'name' => 'PLastik tipis',
            'description' => 'Barang Jadi',
            'is_active' => true
        ]);
        SubGroup::create([
            'group_id' => 2,
            'name' => 'Material Utama',
            'description' => ' ',
            'is_active' => true
        ]);
    }
}
