<?php

namespace Database\Seeders;

use App\Models\Master\ProductionStep;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductionStep::create([
            'name' => 'Raw Material',
            'is_active' => true,
        ]);

        ProductionStep::create([
            'name' => 'Preparation',
            'is_active' => true,
        ]);

        ProductionStep::create([
            'name' => 'Production',
            'is_active' => true,
        ]);

        ProductionStep::create([
            'name' => 'Packaging',
            'is_active' => true,
        ]);

        ProductionStep::create([
            'name' => 'Finished Goods',
            'is_active' => true,
        ]);

        ProductionStep::create([
            'name' => 'Delivery',
            'is_active' => true,
        ]);
    }
}
