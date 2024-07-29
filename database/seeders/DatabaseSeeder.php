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

     //   \App\Models\ModShop::factory()->times(500)->create();
        $this->call(ModShopsSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);

        $this->call(AdminSeeder::class);
        $this->call(ModBottlesSeeder::class);
        $this->call(ModAdditivesSeeder::class);
        $this->call(ModAllergensSeeder::class);
        $this->call(AdminPromoBannerSeeder::class);
        $this->call(ModOrderSeeder::class);
        $this->call(BadwordsTableSeeder::class);


    }



}
