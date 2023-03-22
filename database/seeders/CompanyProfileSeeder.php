<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\Master\CompanyProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyProfile::create([
            'logo' => 'logo.png',
            'name' => 'PT.Yubi Technology',
            'owner' => 'Indra Basuki',
            'email' => 'indrbasuki1@gmail.com',
            'phone' => '081234567890',
            'address' => 'Jl. Boulevard Bar. Raya No.2, RT.2/RW.9, Klp. Gading Barat',
            'city' => 'Jakarta Utara',
            'state' => 'DKI Jakarta',
            'term_and_condition' => 'Lorem Ipsum is simply dummy text of the printing and typ',
        ]);
    }
}
