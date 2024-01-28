<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Berechtigungen erstellen
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);

        // Rollen erstellen und Berechtigungen zuweisen
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('edit articles');
        $adminRole->givePermissionTo('delete articles');
        $adminRole->givePermissionTo('publish articles');

        $superadminRole = Role::create(['name' => 'superadmin']);
        $superadminRole->givePermissionTo('edit articles');
        $superadminRole->givePermissionTo('delete articles');
        $superadminRole->givePermissionTo('publish articles');

        $restaurantRole = Role::create(['name' => 'restaurant']);
        $restaurantRole->givePermissionTo('publish articles');

        $userRole = Role::create(['name' => 'user']);
    }

}
