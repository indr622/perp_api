<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = [


            [
                'group_name' => 'Master',
                'permissions' => [
                    'Manage-Master',
                ]
            ],
            [
                'group_name' => 'Quotation',
                'permissions' => [
                    'Quotation-View',
                    'Quotation-Create',
                    'Quotation-Edit',

                ]
            ],
            [
                'group_name' => 'Sales Order',
                'permissions' => [
                    'Sales-Order-View',
                    'Sales-Order-Create',
                    'Sales-Order-Edit',
                ]
            ],
            [
                'group_name' => 'Work Order',
                'permissions' => [
                    'Work-Order-View',
                    'Work-Order-Create',
                    'Work-Order-Edit',
                ]
            ],
            [
                'group_name' => 'WIP',
                'permissions' => [
                    'WIP-View',
                    'WIP-Create',
                    'WIP-Edit',
                ]
            ],
            [
                'group_name' => 'Purchase Order',
                'permissions' => [
                    'Purchase-Order-View',
                    'Purchase-Order-Create',
                    'Purchase-Order-Edit',
                ]
            ],
            [
                'group_name' => 'Shipping Intruction',
                'permissions' => [
                    'Shipping-Intuction-View',
                    'Shipping-Intuction-Create',
                    'Shipping-Intuction-Edit',
                ]
            ],
            [
                'group_name' => 'Purchase Invoice',
                'permissions' => [
                    'Purchase-Invoice-View',
                    'Purchase-Invoice-Create',
                    'Purchase-Invoice-Edit',
                ]
            ],

            [
                'group_name' => 'Purchase Adjusment',
                'permissions' => [
                    'Purchase-Adjusment-View',
                    'Purchase-Adjusment-Create',
                    'Purchase-Adjusment-Edit',
                ]
            ],

            [
                'group_name' => 'Shipping Invoice',
                'permissions' => [
                    'Sales-Invoice-View',
                    'Sales-Invoice-Create',
                    'Sales-Invoice-Edit',
                ]
            ],
            [
                'group_name' => 'Shipping Invoice Adjusment',
                'permissions' => [
                    'Sales-Invoice-Adjusment-View',
                    'Sales-Invoice-Adjusment-Create',
                    'Sales-Invoice-Adjusment-Edit',
                ]
            ],


        ];

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'guard_name' => 'api', 'group_name' => $permissionGroup]);
            }
        }

        // Create Default Roles
        $superadmin         = Role::create(['name' => 'superadmin', 'guard_name' => 'api']);
        $admin              = Role::create(['name' => 'admin', 'guard_name' => 'api']);

        //Superadmin
        $superadmin->givePermissionTo('Manage-Master');
        $superadmin->givePermissionTo('Quotation-View');
        $superadmin->givePermissionTo('Quotation-Create');
        $superadmin->givePermissionTo('Quotation-Edit');
        $superadmin->givePermissionTo('Sales-Order-View');
        $superadmin->givePermissionTo('Sales-Order-Create');
        $superadmin->givePermissionTo('Sales-Order-Edit');
        $superadmin->givePermissionTo('Work-Order-View');
        $superadmin->givePermissionTo('Work-Order-Create');
        $superadmin->givePermissionTo('Work-Order-Edit');
        $superadmin->givePermissionTo('WIP-View');
        $superadmin->givePermissionTo('WIP-Create');
        $superadmin->givePermissionTo('WIP-Edit');
        $superadmin->givePermissionTo('Purchase-Order-View');
        $superadmin->givePermissionTo('Purchase-Order-Create');
        $superadmin->givePermissionTo('Purchase-Order-Edit');
        $superadmin->givePermissionTo('Purchase-Invoice-View');
        $superadmin->givePermissionTo('Purchase-Invoice-Create');
        $superadmin->givePermissionTo('Purchase-Invoice-Edit');
        $superadmin->givePermissionTo('Purchase-Adjusment-View');
        $superadmin->givePermissionTo('Purchase-Adjusment-Create');
        $superadmin->givePermissionTo('Purchase-Adjusment-Edit');


        //Admin
        $admin->givePermissionTo('Quotation-View');
        $admin->givePermissionTo('Quotation-Create');
        $admin->givePermissionTo('Quotation-Edit');
        $admin->givePermissionTo('Sales-Order-View');
        $admin->givePermissionTo('Sales-Order-Create');
        $admin->givePermissionTo('Sales-Order-Edit');
        $admin->givePermissionTo('Work-Order-View');
        $admin->givePermissionTo('Work-Order-Create');
        $admin->givePermissionTo('Work-Order-Edit');
        $admin->givePermissionTo('WIP-View');
        $admin->givePermissionTo('WIP-Create');
        $admin->givePermissionTo('WIP-Edit');
        $admin->givePermissionTo('Purchase-Order-View');
        $admin->givePermissionTo('Purchase-Order-Create');
        $admin->givePermissionTo('Purchase-Order-Edit');
        $admin->givePermissionTo('Purchase-Invoice-View');
        $admin->givePermissionTo('Purchase-Invoice-Create');
        $admin->givePermissionTo('Purchase-Invoice-Edit');
        $admin->givePermissionTo('Purchase-Adjusment-View');
        $admin->givePermissionTo('Purchase-Adjusment-Create');
        $admin->givePermissionTo('Purchase-Adjusment-Edit');
    }
}
