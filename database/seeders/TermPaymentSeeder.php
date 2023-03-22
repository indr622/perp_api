<?php

namespace Database\Seeders;

use App\Models\Master\TermPayment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TermPayment::create([
            'name' => 'Cash',
            'description' => 'Cash',
            'is_active' => true,
        ]);
        TermPayment::create([
            'name' => '30 Days',
            'description' => '30 Days',
            'is_active' => true,
        ]);
        TermPayment::create([
            'name' => '60 Days',
            'description' => '60 Days',
            'is_active' => true,
        ]);
        TermPayment::create([
            'name' => '90 Days',
            'description' => '90 Days',
            'is_active' => true,
        ]);
        TermPayment::create([
            'name' => '120 Days',
            'description' => '120 Days',
            'is_active' => true,
        ]);
    }
}
