<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Rollen erstellen (nur wenn sie nicht bereits existieren)
        $this->createRoleIfNotExists('superadmin');
        $this->createRoleIfNotExists('admin');
        $this->createRoleIfNotExists('restaurant');
        $this->createRoleIfNotExists('customer');

        // 50 Benutzer erstellen
        for ($i = 1; $i <= 50; $i++) {
            $role = $this->getRandomRole();
            $user = User::create([
                'name' => "User{$i}",
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'), // Hier solltest du ein sicheres Passwort verwenden
                'ip_address' => '127.0.0.1', // Beispiel-IP-Adresse
            ]);

            $user->assignRole($role);
        }
    }

    private function getRandomRole()
    {
        $roles = ['superadmin', 'admin', 'restaurant', 'customer'];
        return $roles[array_rand($roles)];
    }

    private function createRoleIfNotExists($roleName)
    {
        if (!Role::where('name', $roleName)->exists()) {
            Role::create(['name' => $roleName]);
        }
    }
}
