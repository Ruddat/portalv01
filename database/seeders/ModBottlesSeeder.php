<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModBottlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('mod_bottles')->insert([
            [
                'bottles_title' => 'Einwegflaschen (Glas und PET)',
                'bottles_value' => 0.25,
                'ordering' => 1,
                'date' => now(),
            ],
            [
                'bottles_title' => 'Einwegdosen',
                'bottles_value' => 0.25,
                'ordering' => 2,
                'date' => now(),
            ],
            [
                'bottles_title' => 'Mehrwegbierflasche (Glas)',
                'bottles_value' => 0.08,
                'ordering' => 3,
                'date' => now(),
            ],
            [
                'bottles_title' => 'Mehrwegbierflasche (Glas mit Bügelverschluss)',
                'bottles_value' => 0.15,
                'ordering' => 4,
                'date' => now(),
            ],
            [
                'bottles_title' => 'Mehrwegwasserflasche (Glas oder PET)',
                'bottles_value' => 0.15,
                'ordering' => 5,
                'date' => now(),
            ],
            [
                'bottles_title' => 'Mehrwegflasche für Saft und Softdrinks',
                'bottles_value' => 0.15,
                'ordering' => 6,
                'date' => now(),
            ],
            [
                'bottles_title' => 'Milchprodukte oder Alkoholika in Flaschen',
                'bottles_value' => 0,
                'ordering' => 7,
                'date' => now(),
            ],
        ]);
    }
}
