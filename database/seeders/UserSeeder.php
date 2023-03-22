<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'phone' => '0123456789',
            'avatar' => 'https://i.pravatar.cc/150?img=1',
            'address' => 'Jl. Kebon Jeruk No. 1',
            'city' => 'Jakarta Barat',
            'state' => 'DKI Jakarta',
            'zip' => '12345',
            'is_active' => 1,
        ]);
        $superadmin->assignRole('superadmin');

        $admin = User::create([
            'username' => 'admin2',
            'name' => 'Admin 2',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('admin'),
            'phone' => '012345213789',
            'avatar' => 'https://i.pravatar.cc/150?img=1',
            'address' => 'Jl. Kebon Jeruk No. 2',
            'city' => 'Jakarta Barat',
            'state' => 'DKI Jakarta',
            'zip' => '12345',
            'is_active' => 1,
        ]);
        $admin->assignRole('admin');
    }
}
