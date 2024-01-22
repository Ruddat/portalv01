<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModShop>
 */
class ModShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        // Generiere zufällige Koordinaten im Umkreis von 100km um eine bestimmte Referenzposition
        $referenceLatitude = 48.8566; // Beispiel-Latitude (zum Beispiel Paris)
        $referenceLongitude = 2.3522; // Beispiel-Longitude (zum Beispiel Paris)
        $distance = 100; // Umkreis in Kilometern

        $lat = $this->faker->latitude($referenceLatitude - 1, $referenceLatitude + 1);
        $lng = $this->faker->longitude($referenceLongitude - 1, $referenceLongitude + 1);

        return [
            'parent' => 0,
            'shop_nr' => $this->faker->unique()->numberBetween(1000, 9999),
            'title' => $this->faker->unique()->company,
            'street' => $this->faker->streetAddress,
            'zip' => $this->faker->postcode,
            'city' => $this->faker->city,
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'categories' => $this->faker->word,
            'charge' => $this->faker->randomFloat(2, 0, 1000),
            'markup' => $this->faker->randomFloat(2, 0, 1000),
            'per_order' => $this->faker->randomFloat(2, 0, 1000),
            'price_sms' => $this->faker->randomFloat(2, 0, 1000),
            'broker' => $this->faker->randomFloat(2, 0, 1000),
            'registration_price' => $this->faker->randomFloat(2, 0, 1000),
            'order_email' => $this->faker->email,
            'order_fax' => $this->faker->phoneNumber,
            'order_sms' => $this->faker->phoneNumber,
            'order_account_nr' => $this->faker->bankAccountNumber,
            'blz' => $this->faker->bankRoutingNumber,
            'bank' => $this->faker->word,
            'owner' => $this->faker->name,
            'extra_contacts' => $this->faker->paragraph,
            'note' => $this->faker->sentence,
            'accessories' => $this->faker->word,
            'password' => $this->faker->password,
            'transfer' => $this->faker->numberBetween(0, 1),
            'soap_username' => $this->faker->userName,
            'soap_password' => $this->faker->password,
            'feedbacks' => $this->faker->numberBetween(0, 1),
            'justdeliverlogo' => $this->faker->numberBetween(0, 1),
            'domain' => $this->faker->domainName,
            'backlink' => $this->faker->url,
            'cash_active' => $this->faker->numberBetween(0, 1),
            'ec_card_active' => $this->faker->numberBetween(0, 1),
            'ec_card_price' => $this->faker->randomFloat(2, 0, 1000),
            'paypal_active' => $this->faker->numberBetween(0, 1),
            'paypal_use_system' => $this->faker->numberBetween(0, 1),
            'paypal_api_username' => $this->faker->userName,
            'paypal_api_password' => $this->faker->password,
            'paypal_api_signature' => $this->faker->word,
            'paypal_api_endpoint' => $this->faker->url,
            'paypal_url' => $this->faker->url,
            'logo' => $this->faker->imageUrl(),
            'lang' => $this->faker->languageCode,
            'ordering' => $this->faker->randomNumber(),
            'ordering2' => $this->faker->randomNumber(),
            'published' => $this->faker->numberBetween(0, 1),
            'status' => $this->faker->randomElement(['on', 'off', 'closed', 'limited']),
            'activation_date' => $this->faker->dateTime(),
            'date' => $this->faker->dateTime(),
            'contact_info' => $this->faker->paragraph,
            'send_invoice_by' => $this->faker->numberBetween(0, 1),
            'free_orders' => $this->faker->randomNumber(),
            'free_timeline' => $this->faker->date(),
            'per_turnover' => $this->faker->randomFloat(2, 0, 1000),
            'invoice_payment_account' => $this->faker->paragraph,
            'payment_usage_amount' => $this->faker->randomNumber(),
            'no_selbstabholung' => $this->faker->numberBetween(0, 1),
            'rating' => $this->faker->randomFloat(2, 0, 1000),
            'paid_on_top' => $this->faker->randomNumber(),
            'show_logo' => $this->faker->numberBetween(0, 1),
            'have_new_products' => $this->faker->numberBetween(0, 1),
            'actiontime_exist' => $this->faker->numberBetween(0, 1),
            'stickers_exist' => $this->faker->numberBetween(0, 1),
            'fax_activation_error_code' => $this->faker->word,
            'fax_activation_jobID' => $this->faker->word,
            'fax_activation_status' => $this->faker->randomNumber(),
            'fax_activation_started_time' => $this->faker->dateTime(),
            'stickers_from' => $this->faker->randomFloat(2, 0, 1000),
            'auto_payment' => $this->faker->numberBetween(0, 1),
            'new_products_layout' => $this->faker->numberBetween(0, 1),
            'jobs' => $this->faker->paragraph,
            'show_jobs_menu' => $this->faker->numberBetween(0, 1),
            'show_jobs_menu_until' => $this->faker->dateTime(),
            'jobs_email' => $this->faker->email,
            'show_allergenic_menu' => $this->faker->numberBetween(0, 1),
            'design_id' => $this->faker->randomNumber(),
            'eshop_discount' => $this->faker->randomNumber(),
            'eshop_discount_valid' => $this->faker->dateTime(),
            'winorder_version' => $this->faker->word,
            'created_at' => $this->faker->dateTime(),
       //     'updated_at' => $this->faker->dateTime(),
        ];
    }
}
