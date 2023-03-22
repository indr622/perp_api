<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\Master\Supplier;
use App\Models\Master\Vendor;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Supplier::factory()
            ->count(3)
            ->create();
    }
}
