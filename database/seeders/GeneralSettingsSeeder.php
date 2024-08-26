<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('general_settings')->insert([
            'id' => 9,
            'site_name' => 'Mamas Express',
            'site_email' => 'info@mamasexpress.com',
            'site_phone' => null,
            'site_meta_keywords' => null,
            'site_meta_description' => null,
            'site_logo' => null,
            'site_favicon' => null,
            'site_address' => null,
            'created_at' => null,
            'updated_at' => null,
            'paypal_express_fee_fixed' => '0.39',
            'paypal_express_fee_percentage' => '2.99',
            'emergency_sms_cost' => '0.59',
            'service_fee_non_paypal' => '0.59',
            'instant_payout_fee_percentage' => '0.50',
            'sales_commission' => '8.00',
            'company_name' => 'Mamas Express',
            'address' => 'Rebenring 18',
            'postal_code' => '38118',
            'city' => 'Braunschweig',
            'country' => 'Deutschland',
            'ceo_name' => 'Ingo Ruddat',
            'phone' => '+49',
            'bank_name' => 'Commerzbank',
            'iban' => 'xxxxxxxxxx',
            'register_court' => 'Amtsgericht Braunschweig',
            'hrb' => 'HRB',
            'vat_number' => 'USt.-Nr. DE',
            'debit_account' => '1200',
            'credit_account' => '8400',
            'tax_key' => '19',
            'currency' => 'EUR',
            'document_number_range' => 'ME',
            'key' => '',
            'minimum_bid' => '0.50',
            'minimum_bid_factor' => '0.08',
        ]);
    }
}
