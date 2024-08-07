<?php

namespace app\helpers;

class GenderHelper
{
    protected static $maleNames = [
        'John', 'Paul', 'Mike', 'Kevin', 'Steve', 'Ingo', 'Horst', 'Ramazan', 'Memet', // füge hier weitere männliche Namen hinzu
    ];

    protected static $femaleNames = [
        'Mary', 'Linda', 'Susan', 'Karen', 'Nancy', 'Dunja', 'Mia', 'Ingrid', 'Stella', 'Rianna', // füge hier weitere weibliche Namen hinzu
    ];

    public static function determineGender($name)
    {
        $firstName = explode(' ', $name)[0]; // Nimmt den ersten Namensteil an

        if (in_array($firstName, self::$maleNames)) {
            return 'male';
        }

        if (in_array($firstName, self::$femaleNames)) {
            return 'female';
        }

        return 'unknown'; // falls der Name nicht in den Listen gefunden wurde
    }
}
