<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\Master\Group;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Group::create([
            'name' => 'Barang Jadi',
            'description' => 'Barang Jadi',
            'is_active' => true
        ]);
        Group::create([
            'name' => 'Barang Mentah',
            'description' => 'Barang Mentah',
            'is_active' => true
        ]);
    }
}
