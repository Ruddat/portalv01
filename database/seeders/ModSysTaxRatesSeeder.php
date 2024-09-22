<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModSysTaxRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taxRates = [
            // Deutschland
            ['country_code' => 'DE', 'standard_rate' => 19.00, 'reduced_rate' => 7.00, 'category' => 'Food'],
            ['country_code' => 'DE', 'standard_rate' => 19.00, 'reduced_rate' => 7.00, 'category' => 'Drinks'],
            ['country_code' => 'DE', 'standard_rate' => 19.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Österreich
            ['country_code' => 'AT', 'standard_rate' => 20.00, 'reduced_rate' => 10.00, 'category' => 'Food'],
            ['country_code' => 'AT', 'standard_rate' => 20.00, 'reduced_rate' => 10.00, 'category' => 'Drinks'],
            ['country_code' => 'AT', 'standard_rate' => 20.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Frankreich
            ['country_code' => 'FR', 'standard_rate' => 20.00, 'reduced_rate' => 5.50, 'category' => 'Food'],
            ['country_code' => 'FR', 'standard_rate' => 20.00, 'reduced_rate' => 5.50, 'category' => 'Drinks'],
            ['country_code' => 'FR', 'standard_rate' => 20.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Italien
            ['country_code' => 'IT', 'standard_rate' => 22.00, 'reduced_rate' => 10.00, 'category' => 'Food'],
            ['country_code' => 'IT', 'standard_rate' => 22.00, 'reduced_rate' => 10.00, 'category' => 'Drinks'],
            ['country_code' => 'IT', 'standard_rate' => 22.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Spanien
            ['country_code' => 'ES', 'standard_rate' => 21.00, 'reduced_rate' => 10.00, 'category' => 'Food'],
            ['country_code' => 'ES', 'standard_rate' => 21.00, 'reduced_rate' => 10.00, 'category' => 'Drinks'],
            ['country_code' => 'ES', 'standard_rate' => 21.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Niederlande
            ['country_code' => 'NL', 'standard_rate' => 21.00, 'reduced_rate' => 9.00, 'category' => 'Food'],
            ['country_code' => 'NL', 'standard_rate' => 21.00, 'reduced_rate' => 9.00, 'category' => 'Drinks'],
            ['country_code' => 'NL', 'standard_rate' => 21.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Schweden
            ['country_code' => 'SE', 'standard_rate' => 25.00, 'reduced_rate' => 12.00, 'category' => 'Food'],
            ['country_code' => 'SE', 'standard_rate' => 25.00, 'reduced_rate' => 12.00, 'category' => 'Drinks'],
            ['country_code' => 'SE', 'standard_rate' => 25.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Polen
            ['country_code' => 'PL', 'standard_rate' => 23.00, 'reduced_rate' => 8.00, 'category' => 'Food'],
            ['country_code' => 'PL', 'standard_rate' => 23.00, 'reduced_rate' => 8.00, 'category' => 'Drinks'],
            ['country_code' => 'PL', 'standard_rate' => 23.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Ungarn
            ['country_code' => 'HU', 'standard_rate' => 27.00, 'reduced_rate' => 5.00, 'category' => 'Food'],
            ['country_code' => 'HU', 'standard_rate' => 27.00, 'reduced_rate' => 5.00, 'category' => 'Drinks'],
            ['country_code' => 'HU', 'standard_rate' => 27.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Portugal
            ['country_code' => 'PT', 'standard_rate' => 23.00, 'reduced_rate' => 13.00, 'category' => 'Food'],
            ['country_code' => 'PT', 'standard_rate' => 23.00, 'reduced_rate' => 13.00, 'category' => 'Drinks'],
            ['country_code' => 'PT', 'standard_rate' => 23.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Irland
            ['country_code' => 'IE', 'standard_rate' => 23.00, 'reduced_rate' => 9.00, 'category' => 'Food'],
            ['country_code' => 'IE', 'standard_rate' => 23.00, 'reduced_rate' => 9.00, 'category' => 'Drinks'],
            ['country_code' => 'IE', 'standard_rate' => 23.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Belgien
            ['country_code' => 'BE', 'standard_rate' => 21.00, 'reduced_rate' => 6.00, 'category' => 'Food'],
            ['country_code' => 'BE', 'standard_rate' => 21.00, 'reduced_rate' => 6.00, 'category' => 'Drinks'],
            ['country_code' => 'BE', 'standard_rate' => 21.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Dänemark
            ['country_code' => 'DK', 'standard_rate' => 25.00, 'reduced_rate' => null, 'category' => 'Food'],
            ['country_code' => 'DK', 'standard_rate' => 25.00, 'reduced_rate' => null, 'category' => 'Drinks'],
            ['country_code' => 'DK', 'standard_rate' => 25.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Finnland
            ['country_code' => 'FI', 'standard_rate' => 24.00, 'reduced_rate' => 14.00, 'category' => 'Food'],
            ['country_code' => 'FI', 'standard_rate' => 24.00, 'reduced_rate' => 14.00, 'category' => 'Drinks'],
            ['country_code' => 'FI', 'standard_rate' => 24.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Griechenland
            ['country_code' => 'GR', 'standard_rate' => 24.00, 'reduced_rate' => 13.00, 'category' => 'Food'],
            ['country_code' => 'GR', 'standard_rate' => 24.00, 'reduced_rate' => 13.00, 'category' => 'Drinks'],
            ['country_code' => 'GR', 'standard_rate' => 24.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Tschechien
            ['country_code' => 'CZ', 'standard_rate' => 21.00, 'reduced_rate' => 15.00, 'category' => 'Food'],
            ['country_code' => 'CZ', 'standard_rate' => 21.00, 'reduced_rate' => 15.00, 'category' => 'Drinks'],
            ['country_code' => 'CZ', 'standard_rate' => 21.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Slowakei
            ['country_code' => 'SK', 'standard_rate' => 20.00, 'reduced_rate' => 10.00, 'category' => 'Food'],
            ['country_code' => 'SK', 'standard_rate' => 20.00, 'reduced_rate' => 10.00, 'category' => 'Drinks'],
            ['country_code' => 'SK', 'standard_rate' => 20.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Estland
            ['country_code' => 'EE', 'standard_rate' => 20.00, 'reduced_rate' => 9.00, 'category' => 'Food'],
            ['country_code' => 'EE', 'standard_rate' => 20.00, 'reduced_rate' => 9.00, 'category' => 'Drinks'],
            ['country_code' => 'EE', 'standard_rate' => 20.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Lettland
            ['country_code' => 'LV', 'standard_rate' => 21.00, 'reduced_rate' => 12.00, 'category' => 'Food'],
            ['country_code' => 'LV', 'standard_rate' => 21.00, 'reduced_rate' => 12.00, 'category' => 'Drinks'],
            ['country_code' => 'LV', 'standard_rate' => 21.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Litauen
            ['country_code' => 'LT', 'standard_rate' => 21.00, 'reduced_rate' => 9.00, 'category' => 'Food'],
            ['country_code' => 'LT', 'standard_rate' => 21.00, 'reduced_rate' => 9.00, 'category' => 'Drinks'],
            ['country_code' => 'LT', 'standard_rate' => 21.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Zypern
            ['country_code' => 'CY', 'standard_rate' => 19.00, 'reduced_rate' => 9.00, 'category' => 'Food'],
            ['country_code' => 'CY', 'standard_rate' => 19.00, 'reduced_rate' => 9.00, 'category' => 'Drinks'],
            ['country_code' => 'CY', 'standard_rate' => 19.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Malta
            ['country_code' => 'MT', 'standard_rate' => 18.00, 'reduced_rate' => 5.00, 'category' => 'Food'],
            ['country_code' => 'MT', 'standard_rate' => 18.00, 'reduced_rate' => 5.00, 'category' => 'Drinks'],
            ['country_code' => 'MT', 'standard_rate' => 18.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Luxemburg
            ['country_code' => 'LU', 'standard_rate' => 17.00, 'reduced_rate' => 8.00, 'category' => 'Food'],
            ['country_code' => 'LU', 'standard_rate' => 17.00, 'reduced_rate' => 8.00, 'category' => 'Drinks'],
            ['country_code' => 'LU', 'standard_rate' => 17.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Slowenien
            ['country_code' => 'SI', 'standard_rate' => 22.00, 'reduced_rate' => 9.50, 'category' => 'Food'],
            ['country_code' => 'SI', 'standard_rate' => 22.00, 'reduced_rate' => 9.50, 'category' => 'Drinks'],
            ['country_code' => 'SI', 'standard_rate' => 22.00, 'reduced_rate' => null, 'category' => 'Non-Food'],

            // Kroatien
            ['country_code' => 'HR', 'standard_rate' => 25.00, 'reduced_rate' => 13.00, 'category' => 'Food'],
            ['country_code' => 'HR', 'standard_rate' => 25.00, 'reduced_rate' => 13.00, 'category' => 'Drinks'],
            ['country_code' => 'HR', 'standard_rate' => 25.00, 'reduced_rate' => null, 'category' => 'Non-Food'],
        ];

        DB::table('mod_sys_tax_rates')->insert($taxRates);
    }
}
