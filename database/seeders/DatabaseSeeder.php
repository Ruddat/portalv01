<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\ModShop::factory()->times(350)->create();
        $this->call(RolesAndPermissionsSeeder::class);

        $this->call(AdminSeeder::class);
        $this->call(ModBottlesSeeder::class);
        $this->call(ModAdditivesSeeder::class);
        $this->call(ModAllergensSeeder::class);


    }



}
