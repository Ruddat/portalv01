<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModBottlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('mod_bottles')->insert([
            [
                'botles_title' => 'Einwegflaschen (Glas und PET)',
                'botles_value' => 0.25,
                'botles_ordering' => 1,
                'botles_date' => now(),
            ],
            [
                'botles_title' => 'Einwegdosen',
                'botles_value' => 0.25,
                'botles_ordering' => 2,
                'botles_date' => now(),
            ],
            [
                'botles_title' => 'Mehrwegbierflasche (Glas)',
                'botles_value' => 0.08,
                'botles_ordering' => 3,
                'botles_date' => now(),
            ],
            [
                'botles_title' => 'Mehrwegbierflasche (Glas mit Bügelverschluss)',
                'botles_value' => 0.15,
                'botles_ordering' => 4,
                'botles_date' => now(),
            ],
            [
                'botles_title' => 'Mehrwegwasserflasche (Glas oder PET)',
                'botles_value' => 0.15,
                'botles_ordering' => 5,
                'botles_date' => now(),
            ],
            [
                'botles_title' => 'Mehrwegflasche für Saft und Softdrinks',
                'botles_value' => 0.15,
                'botles_ordering' => 6,
                'botles_date' => now(),
            ],
            [
                'botles_title' => 'Milchprodukte oder Alkoholika in Flaschen',
                'botles_value' => 0,
                'botles_ordering' => 7,
                'botles_date' => now(),
            ],
        ]);
    }
}
