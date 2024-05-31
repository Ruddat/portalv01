<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Provider\Base as BaseProvider;

class RestaurantProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Restaurant name generator.
     */
    public function restaurant()
    {
        $adjectives = [
            'Tasty', 'Delicious', 'Gourmet', 'Savory', 'Yummy', 'Succulent',
            'Spicy', 'Juicy', 'Crispy', 'Hearty', 'Fresh', 'Exquisite',
            'Smoky', 'Flavorful', 'Zesty', 'Aromatic', 'Mouthwatering', 'Divine',
            'Authentic', 'Traditional', 'Homemade', 'Sizzling', 'Buttery', 'Creamy', 'Watering',
        ];

        $nouns = [
            'Bistro', 'Café', 'Eatery', 'Diner', 'Restaurant', 'Grill', 'Steakhouse', 'Brasserie',
            'Kitchen', 'Joint', 'Spot', 'Place', 'Bar', 'Pub', 'Beast Pizza', 'Pizza Place',
            'Tavern', 'Lounge', 'House', 'Hideaway', 'Hangout', 'Canteen', 'Pizza Express',
            'Eatery', 'Corner', 'Pizzeria', 'Trattoria', 'Osteria', 'Ristorante',
            'Sushi Bar', 'Izakaya', 'Sashimi', 'Sushi House', 'Sushi Spot', 'Sushi Lounge'
        ];

        $adjective = $adjectives[array_rand($adjectives)];
        $noun = $nouns[array_rand($nouns)];

        return $adjective . ' ' . $noun;
    }

}
