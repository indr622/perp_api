<?php

namespace Database\Seeders;

use App\Models\Master\TermShipping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TermShipping::create([
            'name' => 'FOB',
            'description' => 'FOB',
            'is_active' => true,
        ]);
        TermShipping::create([
            'name' => 'CIF',
            'description' => 'CIF',
            'is_active' => true,
        ]);
        TermShipping::create([
            'name' => 'C&F',
            'description' => 'C&F',
            'is_active' => true,
        ]);
        TermShipping::create([
            'name' => 'EXW',
            'description' => 'EXW',
            'is_active' => true,
        ]);
    }
}
