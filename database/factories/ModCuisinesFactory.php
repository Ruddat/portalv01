<?php

namespace Database\Factories;

use App\Models\ModCuisines;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModCuisines>
 */
class ModCuisinesFactory extends Factory
{

    protected $model = ModCuisines::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     public function definition()
     {
        $cuisines = [
            'Vietnamese Delivery', 'Chinese Delivery', 'Italian Delivery', 'Mexican Delivery',
            'Japanese Delivery', 'Indian Delivery', 'Thai Delivery', 'Greek Delivery',
            'French Delivery', 'Spanish Delivery', 'American BBQ', 'Lebanese Delivery',
            'Turkish Delivery', 'Korean Delivery', 'Brazilian Delivery', 'Portuguese Delivery',
            'Russian Delivery', 'Moroccan Delivery', 'Egyptian Delivery', 'Ethiopian Delivery',
            'Pakistani Delivery', 'Bangladeshi Delivery', 'Nepalese Delivery', 'Sri Lankan Delivery',
            'Mediterranean Delivery', 'Middle Eastern Delivery', 'Armenian Delivery', 'Georgian Delivery',
            'Hungarian Delivery', 'Polish Delivery', 'Cuban Delivery', 'Colombian Delivery',
            'Argentinian Delivery', 'Peruvian Delivery', 'Venezuelan Delivery', 'Uruguayan Delivery',
            'Chilean Delivery', 'Bolivian Delivery', 'Salvadoran Delivery', 'Guatemalan Delivery',
            'Honduran Delivery', 'Nicaraguan Delivery', 'Costa Rican Delivery', 'Panamanian Delivery',
            'Jamaican Delivery', 'Barbadian Delivery', 'Trinidadian Delivery', 'Saint Lucian Delivery',
            'Saint Vincentian Delivery', 'Grenadian Delivery', 'Antiguan Delivery', 'Saint Kitts Delivery',
            'Saint Nevis Delivery', 'Belizean Delivery', 'Mayan Delivery', 'Andean Delivery',
            'Galician Delivery', 'Catalan Delivery', 'Basque Delivery', 'Swiss Delivery',
            'Belgian Delivery', 'Dutch Delivery', 'German Delivery', 'Austrian Delivery',
            'Swiss Alpine Delivery', 'Scandinavian Delivery', 'Danish Delivery', 'Swedish Delivery',
            'Norwegian Delivery', 'Finnish Delivery', 'Icelandic Delivery', 'British Delivery',
            'Irish Delivery', 'Scottish Delivery', 'Welsh Delivery', 'Australian Delivery',
            'New Zealand Delivery', 'Fijian Delivery', 'Tongan Delivery', 'Samoan Delivery',
            'Papua New Guinean Delivery', 'Australian Aboriginal Delivery', 'Native American Delivery',
            'Hawaiian Delivery', 'Kauai Delivery', 'Oahu Delivery', 'Maui Delivery', 'Molokai Delivery'
        ];

         return [
             'name' => $this->faker->randomElement($cuisines),
         ];
     }
}
