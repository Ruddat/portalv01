<?php

namespace app\helpers;

use App\Models\Client;

class CoolUsernameHelper
{
    protected static $adjectives = [
        'Witty', 'Crazy', 'Cool', 'Funny', 'Wild', 'Charming', 'Quirky', 'Happy', 'Silly', 'Jolly', 'Giddy', 'Zany', 'Cheerful', 'Sunny', 'Snazzy',
        'Brave', 'Bright', 'Clever', 'Daring', 'Dashing', 'Energetic', 'Friendly', 'Gentle', 'Graceful', 'Jovial', 'Lively', 'Merry', 'Playful', 'Radiant',
        'Sassy', 'Smart', 'Sparkly', 'Sprightly', 'Vivid', 'Witty', 'Zippy', 'Bubbly', 'Eager', 'Fearless', 'Gleeful', 'Kind', 'Peppy', 'Upbeat'
    ];

    protected static $nouns = [
        'Panda', 'Ninja', 'Pirate', 'Unicorn', 'Dolphin', 'Koala', 'Giraffe', 'Penguin', 'Elephant', 'Kangaroo', 'Zebra', 'Dragon', 'Phoenix', 'Griffin', 'Mermaid',
        'Tiger', 'Lion', 'Leopard', 'Panther', 'Cheetah', 'Bear', 'Hawk', 'Falcon', 'Eagle', 'Wolf', 'Fox', 'Deer', 'Otter', 'Whale', 'Shark', 'Octopus',
        'Butterfly', 'Firefly', 'Ladybug', 'Beetle', 'Bumblebee', 'Cricket', 'Hummingbird', 'Raven', 'Sparrow', 'Swallow', 'Jay', 'Woodpecker', 'Starling', 'Finch'
    ];

    public static function generate($name)
    {
        do {
            $namePart = ucfirst(preg_replace('/\s+/', '', $name)); // Entferne Leerzeichen und setze den ersten Buchstaben groß
            $adjective = self::$adjectives[array_rand(self::$adjectives)];
            $number = rand(1, 9999);

            $username = $adjective . $namePart . $number;
        } while (Client::where('username', $username)->exists());

        return $username;
    }
}
