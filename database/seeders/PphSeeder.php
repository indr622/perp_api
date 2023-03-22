<?php

namespace Database\Seeders;

use App\Models\Master\Pph;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PphSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pph::create(['percentage' => 0, 'is_active' => true]);
        Pph::create(['percentage' => 2, 'is_active' => true]);
        Pph::create(['percentage' => 4, 'is_active' => true]);
        Pph::create(['percentage' => 6, 'is_active' => true]);
        Pph::create(['percentage' => 8, 'is_active' => true]);
        Pph::create(['percentage' => 10, 'is_active' => true]);
    }
}
