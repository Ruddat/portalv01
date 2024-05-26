<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModShop;
use Faker\Factory as Faker;
use App\Providers\RestaurantProvider;

class ModShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  $faker = Faker::create('de_DE');
        $faker = \Faker\Factory::create('de_DE');
        $faker->addProvider(new RestaurantProvider($faker));

        // Liste der Bundesländer mit Städten, deren Koordinaten und Radien in Kilometern
        $bundeslaender = [
            'Baden-Württemberg' => [
                ['city' => 'Stuttgart', 'lat' => 48.7758, 'lng' => 9.1829, 'radius' => 10],
                ['city' => 'Karlsruhe', 'lat' => 49.0069, 'lng' => 8.4037, 'radius' => 10],
                ['city' => 'Mannheim', 'lat' => 49.4875, 'lng' => 8.4660, 'radius' => 10],
                ['city' => 'Freiburg im Breisgau', 'lat' => 47.9990, 'lng' => 7.8421, 'radius' => 10],
                ['city' => 'Heidelberg', 'lat' => 49.3988, 'lng' => 8.6724, 'radius' => 10],
            ],
            'Bayern' => [
                ['city' => 'München', 'lat' => 48.1351, 'lng' => 11.5820, 'radius' => 10],
                ['city' => 'Nürnberg', 'lat' => 49.4521, 'lng' => 11.0767, 'radius' => 10],
                ['city' => 'Augsburg', 'lat' => 48.3705, 'lng' => 10.8978, 'radius' => 10],
                ['city' => 'Regensburg', 'lat' => 49.0134, 'lng' => 12.1016, 'radius' => 10],
                ['city' => 'Würzburg', 'lat' => 49.7913, 'lng' => 9.9534, 'radius' => 10],
            ],
            'Berlin' => [
                ['city' => 'Berlin', 'lat' => 52.5200, 'lng' => 13.4050, 'radius' => 10],
            ],
            'Brandenburg' => [
                ['city' => 'Potsdam', 'lat' => 52.3906, 'lng' => 13.0645, 'radius' => 10],
                ['city' => 'Cottbus', 'lat' => 51.7563, 'lng' => 14.3329, 'radius' => 10],
                ['city' => 'Brandenburg an der Havel', 'lat' => 52.4143, 'lng' => 12.5576, 'radius' => 10],
                ['city' => 'Frankfurt (Oder)', 'lat' => 52.3471, 'lng' => 14.5506, 'radius' => 10],
            ],
            'Bremen' => [
                ['city' => 'Bremen', 'lat' => 53.0793, 'lng' => 8.8017, 'radius' => 10],
                ['city' => 'Bremerhaven', 'lat' => 53.5396, 'lng' => 8.5809, 'radius' => 10],
            ],
            'Hamburg' => [
                ['city' => 'Hamburg', 'lat' => 53.5511, 'lng' => 9.9937, 'radius' => 10],
            ],
            'Hessen' => [
                ['city' => 'Frankfurt am Main', 'lat' => 50.1109, 'lng' => 8.6821, 'radius' => 10],
                ['city' => 'Wiesbaden', 'lat' => 50.0826, 'lng' => 8.2400, 'radius' => 10],
                ['city' => 'Kassel', 'lat' => 51.3127, 'lng' => 9.4797, 'radius' => 10],
                ['city' => 'Darmstadt', 'lat' => 49.8728, 'lng' => 8.6512, 'radius' => 10],
            ],
            'Mecklenburg-Vorpommern' => [
                ['city' => 'Rostock', 'lat' => 54.0924, 'lng' => 12.0991, 'radius' => 10],
                ['city' => 'Schwerin', 'lat' => 53.6355, 'lng' => 11.4167, 'radius' => 10],
                ['city' => 'Neubrandenburg', 'lat' => 53.5633, 'lng' => 13.2755, 'radius' => 10],
            ],
            'Niedersachsen' => [
                ['city' => 'Hannover', 'lat' => 52.3759, 'lng' => 9.7320, 'radius' => 10],
                ['city' => 'Braunschweig', 'lat' => 52.2689, 'lng' => 10.5268, 'radius' => 10],
                ['city' => 'Oldenburg', 'lat' => 53.1435, 'lng' => 8.2146, 'radius' => 10],
                ['city' => 'Osnabrück', 'lat' => 52.2799, 'lng' => 8.0472, 'radius' => 10],
                ['city' => 'Wolfsburg', 'lat' => 52.4227, 'lng' => 10.7865, 'radius' => 10],
                ['city' => 'Göttingen', 'lat' => 51.5413, 'lng' => 9.9158, 'radius' => 10],
                ['city' => 'Salzgitter', 'lat' => 52.1532, 'lng' => 10.3696, 'radius' => 10],
                ['city' => 'Hildesheim', 'lat' => 52.1508, 'lng' => 9.9510, 'radius' => 10],
                ['city' => 'Celle', 'lat' => 52.6226, 'lng' => 10.0805, 'radius' => 10],
                ['city' => 'Lüneburg', 'lat' => 53.2460, 'lng' => 10.4115, 'radius' => 10],
                ['city' => 'Delmenhorst', 'lat' => 53.0493, 'lng' => 8.6326, 'radius' => 10],
                ['city' => 'Wilhelmshaven', 'lat' => 53.5299, 'lng' => 8.1120, 'radius' => 10],
                ['city' => 'Salzgitter', 'lat' => 52.1394, 'lng' => 10.3550, 'radius' => 10],
                ['city' => 'Hameln', 'lat' => 52.1046, 'lng' => 9.3562, 'radius' => 10],
                ['city' => 'Nordhorn', 'lat' => 52.4306, 'lng' => 7.0723, 'radius' => 10],
                ['city' => 'Wunstorf', 'lat' => 52.4220, 'lng' => 9.4284, 'radius' => 10],
                ['city' => 'Peine', 'lat' => 52.3205, 'lng' => 10.2354, 'radius' => 10],
                ['city' => 'Edemissen', 'lat' => 52.392649, 'lng' => 10.352971, 'radius' => 10],
                ['city' => 'Hillerse', 'lat' => 52.3754, 'lng' => 10.3396, 'radius' => 10],
            ],
            'Nordrhein-Westfalen' => [
                ['city' => 'Köln', 'lat' => 50.9375, 'lng' => 6.9603, 'radius' => 10],
                ['city' => 'Düsseldorf', 'lat' => 51.2277, 'lng' => 6.7735, 'radius' => 10],
                ['city' => 'Dortmund', 'lat' => 51.5136, 'lng' => 7.4653, 'radius' => 10],
                ['city' => 'Essen', 'lat' => 51.4556, 'lng' => 7.0116, 'radius' => 10],
                ['city' => 'Duisburg', 'lat' => 51.4344, 'lng' => 6.7623, 'radius' => 10],
            ],
            'Rheinland-Pfalz' => [
                ['city' => 'Mainz', 'lat' => 49.9929, 'lng' => 8.2473, 'radius' => 10],
                ['city' => 'Ludwigshafen am Rhein', 'lat' => 49.4774, 'lng' => 8.4452, 'radius' => 10],
                ['city' => 'Koblenz', 'lat' => 50.3569, 'lng' => 7.5880, 'radius' => 10],
                ['city' => 'Trier', 'lat' => 49.7499, 'lng' => 6.6371, 'radius' => 10],
            ],
            'Saarland' => [
                ['city' => 'Saarbrücken', 'lat' => 49.2402, 'lng' => 6.9969, 'radius' => 10],
            ],
            'Sachsen' => [
                ['city' => 'Dresden', 'lat' => 51.0504, 'lng' => 13.7373, 'radius' => 10],
                ['city' => 'Leipzig', 'lat' => 51.3397, 'lng' => 12.3731, 'radius' => 10],
                ['city' => 'Chemnitz', 'lat' => 50.8278, 'lng' => 12.9214, 'radius' => 10],
            ],
            'Sachsen-Anhalt' => [
                ['city' => 'Magdeburg', 'lat' => 52.1205, 'lng' => 11.6276, 'radius' => 10],
                ['city' => 'Halle (Saale)', 'lat' => 51.4823, 'lng' => 11.9690, 'radius' => 10],
                ['city' => 'Dessau-Roßlau', 'lat' => 51.8384, 'lng' => 12.2455, 'radius' => 10],
            ],
            'Schleswig-Holstein' => [
                ['city' => 'Kiel', 'lat' => 54.3233, 'lng' => 10.1228, 'radius' => 10],
                ['city' => 'Lübeck', 'lat' => 53.8655, 'lng' => 10.6866, 'radius' => 10],
                ['city' => 'Flensburg', 'lat' => 54.7930, 'lng' => 9.4466, 'radius' => 10],
                ['city' => 'Neumünster', 'lat' => 54.0748, 'lng' => 9.9819, 'radius' => 10],
                ['city' => 'Norderstedt', 'lat' => 53.7088, 'lng' => 9.9807, 'radius' => 10],
                ['city' => 'Elmshorn', 'lat' => 53.7537, 'lng' => 9.6536, 'radius' => 10],
                ['city' => 'Pinneberg', 'lat' => 53.6612, 'lng' => 9.7941, 'radius' => 10],
                ['city' => 'Itzehoe', 'lat' => 53.9279, 'lng' => 9.5156, 'radius' => 10],
                ['city' => 'Wedel', 'lat' => 53.5832, 'lng' => 9.7037, 'radius' => 10],
                ['city' => 'Rendsburg', 'lat' => 54.3013, 'lng' => 9.6630, 'radius' => 10],
                ['city' => 'Ahrensburg', 'lat' => 53.6777, 'lng' => 10.2253, 'radius' => 10],
                ['city' => 'Geesthacht', 'lat' => 53.4377, 'lng' => 10.3797, 'radius' => 10],
                ['city' => 'Henstedt-Ulzburg', 'lat' => 53.7947, 'lng' => 9.9890, 'radius' => 10],
                ['city' => 'Husum', 'lat' => 54.4756, 'lng' => 9.0522, 'radius' => 10],
                ['city' => 'Reinbek', 'lat' => 53.5192, 'lng' => 10.2425, 'radius' => 10],
                ['city' => 'Eutin', 'lat' => 54.1407, 'lng' => 10.6194, 'radius' => 10],
            ],
            // Weitere Bundesländer und Städte...
        ];

        foreach ($bundeslaender as $bundesland => $cities) {
            foreach ($cities as $cityData) {
                for ($i = 0; $i < 5; $i++) { // Generiere 10 Shops pro Stadt
                    [$lat, $lng] = $this->generateRandomCoordinates($cityData['lat'], $cityData['lng'], $cityData['radius']);
                    ModShop::create([
                        'parent' => 0,
                        'shop_nr' => $faker->unique()->numberBetween(1000, 9999),
                        'shop_slug' => $faker->slug, // 'shop_slug' hinzugefügt
                      //  'title' => $faker->unique()->company,
                      'title' => $faker->restaurant,

                      'street' => $faker->streetAddress(),
                        'zip' => $faker->postcode,
                        'city' => $cityData['city'],
                        'lat' => $lat,
                        'lng' => $lng,
                        'phone' => $faker->phoneNumber,
                        'email' => $faker->unique()->safeEmail,
                        'categories' => $faker->word,
                        'charge' => $faker->randomFloat(2, 0, 1000),
                        'markup' => $faker->randomFloat(2, 0, 1000),
                        'per_order' => $faker->randomFloat(2, 0, 1000),
                        'price_sms' => $faker->randomFloat(2, 0, 1000),
                        'registration_price' => $faker->randomFloat(2, 0, 1000),
                        'order_email' => $faker->email,
                        'order_fax' => $faker->phoneNumber,
                        'order_sms' => $faker->phoneNumber,
                        'order_account_nr' => $faker->bankAccountNumber,
                        'blz' => 0,
                        'bank' => $faker->word,
                        'owner' => $faker->name,
                        'extra_contacts' => $faker->paragraph,
                        'note' => $faker->sentence,
                        'accessories' => $faker->word,
                        'password' => $faker->password,
                        'transfer' => $faker->numberBetween(0, 1),
                        'soap_username' => $faker->userName,
                        'soap_password' => $faker->password,
                        'feedbacks' => $faker->numberBetween(0, 1),
                        'justdeliverlogo' => $faker->numberBetween(0, 1),
                        'domain' => $faker->domainName,
                        'backlink' => $faker->url,
                        'cash_active' => $faker->numberBetween(0, 1),
                        'ec_card_active' => $faker->numberBetween(0, 1),
                        'ec_card_price' => $faker->randomFloat(2, 0, 1000),
                        'paypal_active' => $faker->numberBetween(0, 1),
                        'paypal_use_system' => $faker->numberBetween(0, 1),
                        'paypal_api_username' => $faker->userName,
                        'paypal_api_password' => $faker->password,
                        'paypal_api_signature' => $faker->word,
                        'paypal_api_endpoint' => $faker->url,
                        'paypal_url' => $faker->url,
                        'lang' => $faker->languageCode,
                        'ordering' => $faker->randomNumber(),
                        'ordering2' => $faker->randomNumber(),
                        'published' => $faker->numberBetween(0, 1),
                        'status' => $faker->randomElement(['on', 'off', 'closed', 'limited']),
                        'activation_date' => $faker->dateTime(),
                        'date' => $faker->dateTime(),
                        'contact_info' => $faker->paragraph,
                        'send_invoice_by' => $faker->numberBetween(0, 1),
                        'free_orders' => $faker->randomNumber(),
                        'free_timeline' => $faker->date(),
                        'per_turnover' => $faker->randomFloat(2, 0, 1000),
                        'invoice_payment_account' => $faker->paragraph,
                        'payment_usage_amount' => $faker->randomNumber(),
                        'no_abholung' => $faker->numberBetween(0, 1),
                        'no_lieferung' => $faker->numberBetween(0, 1),
                        'paid_on_top' => $faker->randomNumber(),
                        'show_logo' => $faker->numberBetween(0, 1),
                        'have_new_products' => $faker->numberBetween(0, 1),
                        'actiontime_exist' => $faker->numberBetween(0, 1),
                        'stickers_exist' => $faker->numberBetween(0, 1),
                        'fax_activation_error_code' => $faker->word,
                        'fax_activation_jobID' => $faker->word,
                        'fax_activation_status' => $faker->randomNumber(),
                        'fax_activation_started_time' => $faker->date(),
                        'stickers_from' => $faker->randomFloat(2, 0, 1000),
                        'auto_payment' => $faker->numberBetween(0, 1),
                        'new_products_layout' => $faker->numberBetween(0, 1),
                        'jobs' => $faker->paragraph,
                        'show_jobs_menu' => $faker->numberBetween(0, 1),
                        'show_jobs_menu_until' => $faker->dateTime(),
                        'jobs_email' => $faker->email,
                        'show_allergenic_menu' => $faker->numberBetween(0, 1),
                        'design_id' => $faker->randomNumber(),
                        'eshop_discount' => $faker->randomNumber(),
                        'eshop_discount_valid' => $faker->dateTime(),
                        'winorder_version' => $faker->word,
                        'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
                    ]);
                }
            }
        }
    }

    /**
     * Generiere zufällige Koordinaten im Umkreis von $radius km um eine bestimmte Referenzposition.
     *
     * @param float $referenceLatitude
     * @param float $referenceLongitude
     * @param float $radius
     * @return array
     */
    private function generateRandomCoordinates($referenceLatitude, $referenceLongitude, $radius)
    {
        $radiusInDegrees = $radius / 111; // 1 Grad ist ungefähr 111 km

        $u = $this->randomFloat();
        $v = $this->randomFloat();
        $w = $radiusInDegrees * sqrt($u);
        $t = 2 * M_PI * $v;
        $x = $w * cos($t);
        $y = $w * sin($t);

        // Anpassung für die verschiedenen Längen- und Breitengrade
        $newX = $x / cos(deg2rad($referenceLatitude));

        $foundLatitude = $referenceLatitude + $y;
        $foundLongitude = $referenceLongitude + $newX;

        return [$foundLatitude, $foundLongitude];
    }

    /**
     * Generiere eine zufällige Float-Zahl zwischen 0 und 1.
     *
     * @return float
     */
    private function randomFloat()
    {
        return mt_rand() / mt_getrandmax();
    }
}
