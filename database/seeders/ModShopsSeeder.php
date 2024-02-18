<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModShop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       ModShop::factory()->count(500)->create();

      //  $referenceLatitude = 52.392649; // Beispiel-Latitude (zum Beispiel Paris)
      //  $referenceLongitude = 10.352971; // Beispiel-Longitude (zum Beispiel Paris)

        // Verwende die Factory, um 10 Datensätze mit zufälligen Werten im Umkreis von 100 km zu erstellen
     //   ModShop::factory(100)->create([
     //       'lat' => fn() => rand($referenceLatitude - 1, $referenceLatitude + 1),
     //       'lng' => fn() => rand($referenceLongitude - 1, $referenceLongitude + 1),
     //   ]);
    }
}
