<?php

namespace app\helpers;

use App\Models\Client;

class CoolUsernameHelper
{
    protected static $adjectives = [
        'Witty', 'Crazy', 'Cool', 'Funny', 'Wild', 'Charming', 'Quirky', 'Happy', 'Silly', 'Jolly', 'Giddy', 'Zany', 'Cheerful', 'Sunny', 'Snazzy'
    ];

    protected static $nouns = [
        'Panda', 'Ninja', 'Pirate', 'Unicorn', 'Dolphin', 'Koala', 'Giraffe', 'Penguin', 'Elephant', 'Kangaroo', 'Zebra', 'Dragon', 'Phoenix', 'Griffin', 'Mermaid'
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
