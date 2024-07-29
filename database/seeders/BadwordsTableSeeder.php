<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BadwordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $badwords = [
            ['word' => 'arsch'],
            ['word' => 'hitler'],
            ['word' => 'fotze'],
            ['word' => 'hure'],
            ['word' => 'badword5'],
            // Füge hier weitere Badwords hinzu
        ];

        DB::table('mod_admin_badwords')->insert($badwords);
    }
}
