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
                'bottles_ordering' => 1,
                'bottles_date' => now(),
            ],
            [
                'bottles_title' => 'Einwegdosen',
                'bottles_value' => 0.25,
                'bottles_ordering' => 2,
                'bottles_date' => now(),
            ],
            [
                'bottles_title' => 'Mehrwegbierflasche (Glas)',
                'bottles_value' => 0.08,
                'bottles_ordering' => 3,
                'bottles_date' => now(),
            ],
            [
                'bottles_title' => 'Mehrwegbierflasche (Glas mit Bügelverschluss)',
                'bottles_value' => 0.15,
                'bottles_ordering' => 4,
                'bottles_date' => now(),
            ],
            [
                'bottles_title' => 'Mehrwegwasserflasche (Glas oder PET)',
                'bottles_value' => 0.15,
                'bottles_ordering' => 5,
                'bottles_date' => now(),
            ],
            [
                'bottles_title' => 'Mehrwegflasche für Saft und Softdrinks',
                'bottles_value' => 0.15,
                'bottles_ordering' => 6,
                'bottles_date' => now(),
            ],
            [
                'bottles_title' => 'Milchprodukte oder Alkoholika in Flaschen',
                'bottles_value' => 0,
                'bottles_ordering' => 7,
                'bottles_date' => now(),
            ],
        ]);
    }
}
