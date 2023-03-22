<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
            ConfigurationSeeder::class,
            CompanyProfileSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            CurrencySeeder::class,
            PaymentMethodSeeder::class,
            GroupSeeder::class,
            SubGroupSeeder::class,
            UnitSeeder::class,
            PphSeeder::class,
            WarehouseSeeder::class,
            TypeOrderSeeder::class,
            ProductionStepSeeder::class,
            RetailerSeeder::class,
            ItemSeeder::class,
            ProductSeeder::class,
            TermPaymentSeeder::class,
            TermShippingSeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,

            // QuotationSeeder::class,
            // SalesOrderSeeder::class,


        ]);
    }
}
