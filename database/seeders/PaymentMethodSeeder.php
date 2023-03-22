<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\Master\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'name' => 'Cash',
            'description' => 'Cash',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Debit',
            'description' => 'Debit',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Credit',
            'description' => 'Credit',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Transfer',
            'description' => 'Transfer',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Gopay',
            'description' => 'Gopay',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Ovo',
            'description' => 'Ovo',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Dana',
            'description' => 'Dana',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Shopeepay',
            'description' => 'Shopeepay',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Linkaja',
            'description' => 'Linkaja',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Alfamart',
            'description' => 'Alfamart',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Indomaret',
            'description' => 'Indomaret',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Alfamidi',
            'description' => 'Alfamidi',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Kioson',
            'description' => 'Kioson',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Dan+Dan',
            'description' => 'Dan+Dan',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Ceria',
            'description' => 'Ceria',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Kredivo',
            'description' => 'Kredivo',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'BRI E-Pay',
            'description' => 'BRI E-Pay',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'BNI E-Pay',
            'description' => 'BNI E-Pay',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Mandiri E-Pay',
            'description' => 'Mandiri E-Pay',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'BCA E-Pay',
            'description' => 'BCA E-Pay',
            'is_active' => true,
        ]);
    }
}
