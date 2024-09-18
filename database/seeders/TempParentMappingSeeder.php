<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TempParentMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('temp_parent_mapping')->insert([
            ['old_parent_id' => 37, 'new_parent_id' => 39],
            ['old_parent_id' => 42, 'new_parent_id' => 43],
            // Füge weitere Einträge hinzu, wenn nötig
        ]);
    }
}
