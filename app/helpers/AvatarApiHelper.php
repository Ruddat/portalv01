<?php

namespace app\helpers;

use app\helpers\GenderHelper;
use Illuminate\Support\Facades\Http;

class AvatarApiHelper
{
    public static function createAvatar($name)
    {
        // API-URL
        $apiUrl = 'https://avataaars.io/';

        // Geschlecht des Namens bestimmen
        $gender = GenderHelper::determineGender($name);

        // Generiere einzigartige Parameter basierend auf dem Namen
        $hash = md5($name);
        $hairColor = '#' . substr($hash, 0, 6); // Haarfarbe basierend auf dem Namen
        $clotheColor = '#' . substr($hash, 6, 6); // Kleidungfarbe basierend auf dem Namen

        // Zufällige Auswahl von Parametern basierend auf dem Geschlecht
        if ($gender === 'male') {
            $topTypes = ['ShortHairDreads01', 'ShortHairShortCurly', 'ShortHairShortFlat'];
            $facialHairTypes = ['BeardMedium', 'BeardLight', 'MoustacheFancy'];
        } else if ($gender === 'female') {
            $topTypes = ['LongHairStraight', 'LongHairCurly', 'Hijab'];
            $facialHairTypes = ['Blank'];
        } else {
            $topTypes = ['NoHair', 'ShortHairDreads01', 'LongHairStraight', 'LongHairCurly'];
            $facialHairTypes = ['Blank', 'BeardMedium', 'MoustacheFancy'];
        }

        $accessoriesTypes = ['Blank', 'Kurt', 'Prescription01', 'Round'];
        $clotheTypes = ['BlazerShirt', 'BlazerSweater', 'Hoodie', 'Overall'];
        $eyeTypes = ['Default', 'Happy', 'Side', 'Wink'];
        $eyebrowTypes = ['Default', 'RaisedExcited', 'SadConcerned', 'UnibrowNatural'];
        $mouthTypes = ['Default', 'Smile', 'Serious', 'Disbelief'];
        $skinColors = ['Tanned', 'Yellow', 'Pale', 'Light', 'Brown'];

        // Erstelle die URL für den Avatar
        $avatarUrl = $apiUrl . '?' . http_build_query([
            'avatarStyle' => 'Circle',
            'topType' => $topTypes[hexdec(substr($hash, 0, 2)) % count($topTypes)],
            'accessoriesType' => $accessoriesTypes[hexdec(substr($hash, 2, 2)) % count($accessoriesTypes)],
            'hairColor' => $hairColor,
            'facialHairType' => $facialHairTypes[hexdec(substr($hash, 4, 2)) % count($facialHairTypes)],
            'clotheType' => $clotheTypes[hexdec(substr($hash, 6, 2)) % count($clotheTypes)],
            'clotheColor' => $clotheColor,
            'eyeType' => $eyeTypes[hexdec(substr($hash, 8, 2)) % count($eyeTypes)],
            'eyebrowType' => $eyebrowTypes[hexdec(substr($hash, 10, 2)) % count($eyebrowTypes)],
            'mouthType' => $mouthTypes[hexdec(substr($hash, 12, 2)) % count($mouthTypes)],
            'skinColor' => $skinColors[hexdec(substr($hash, 14, 2)) % count($skinColors)],
        ]);

        // Hole das Avatar-Bild
        $response = Http::get($avatarUrl);

        // Überprüfe, ob der Download erfolgreich war
        if ($response->failed()) {
            throw new \Exception('Failed to generate avatar image.');
        }

        $avatarImage = $response->body();

        // Verzeichnis für Avatare sicherstellen
        $avatarDirectory = public_path('storage/avatars');
        if (!is_dir($avatarDirectory)) {
            mkdir($avatarDirectory, 0755, true);
        }

        $avatarPath = 'storage/avatars/' . md5($name) . '_avatar.svg';
        $fullPath = public_path($avatarPath);

        // Speichern des Bildes
        file_put_contents($fullPath, $avatarImage);

        return asset($avatarPath);
    }
}
