<?php

namespace Database\Seeders;

use App\Models\ModOrders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ModOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $start = strtotime('2023-01-01');
        $end = strtotime('2023-12-31');

        for ($i = 0; $i < 5000; $i++) {
            $restaurantId = $faker->numberBetween(1, 400);

            ModOrders::create([
                'order_nr' => $faker->randomNumber(),
                'parent' => $restaurantId,
                'shop_name' => $faker->company,
                'hash' => $faker->unique()->sha1,
                'gender' => $faker->numberBetween(0, 1),
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'company' => $faker->company,
                'department' => $faker->word,
                'email' => $faker->email,
                'phone_prefix' => $faker->optional()->randomNumber(2),
                'phone' => $faker->phoneNumber,
                'clients_ip' => $faker->ipv4,
                'shipping_zip_id' => $faker->numberBetween(1000, 9999),
                'shipping_street' => $faker->streetName,
                'shipping_house_no' => $faker->buildingNumber,
                'shipping_zip' => $faker->postcode,
                'shipping_city' => $faker->city,
                'shipping_state' => $faker->state,
                'shipping_country_code' => 'DE',
                'shipping_lat' => $faker->latitude,
                'shipping_lng' => $faker->longitude,
                'shipping_comment' => $faker->sentence,
                'delivery_time' => $faker->dateTimeBetween('-1 hours', '+3 hours'),
                'shipping_type' => $faker->randomElement(['pickup', 'delivery']),
                'order_comment' => $faker->sentence,
                'payment_type' => $faker->randomElement(['cash', 'ec-card', 'paypal', 'ueberweisung']),
                'price_products' => $faker->randomFloat(2, 5, 100),
                'price_bottles' => $faker->numberBetween(0, 10),
                'price_shipping' => $faker->randomFloat(2, 0, 10),
                'price_payment' => $faker->randomFloat(2, 0, 5),
                'price_tips' => $faker->randomFloat(2, 0, 10),
                'coupon_discount' => $faker->randomFloat(2, 0, 5),
                'eshop_discount' => $faker->randomFloat(2, 0, 5),
                'price_total' => $faker->randomFloat(2, 10, 200),
                'use_system_payment' => $faker->boolean,
                'soap_status' => $faker->numberBetween(0, 3),
                'transfer_type' => $faker->optional()->numberBetween(1, 5),
                'transfer_by_email' => $faker->boolean,
                'transfer_time' => $faker->optional()->dateTimeThisYear,
                'subscribe_news' => $faker->boolean,
                'save_data' => $faker->boolean,
                'published' => $faker->boolean,
                'money_returned' => $faker->boolean,
                'user_id' => $faker->numberBetween(1, 10),
                'stickers_delivery_checked' => $faker->boolean,
                'cart_in_session' => $faker->text,
                'delivery_time_left' => $faker->numberBetween(0, 60),
                'global_coupon_id' => $faker->numberBetween(0, 100),
                'coupon_code' => $faker->word,
                'rand_id' => $faker->regexify('[A-Za-z0-9]{20}'),
                'user_status' => $faker->numberBetween(0, 500),
                'order_date' => $faker->dateTimeBetween($start, $end),
                'order_tracking_status' => $faker->randomElement(['999999', '1', '2', '3', '4', '5', '6', '400', '500']),
                'deliver_eta' => $faker->optional()->time,
                'message' => $faker->optional()->sentence,
                'deliver_minutes' => $faker->optional()->numberBetween(0, 120),
                'reject_reason' => $faker->optional()->sentence,
                'order_json_data' => json_encode($faker->words(10)),
                'created_at' => $faker->dateTimeThisYear,
                'updated_at' => $faker->dateTimeThisYear
            ]);
        }
    }
}
