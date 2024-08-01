<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class CoolAvatarHelper
{
    public static function createCoolAvatar($name)
    {
        // URL von Robohash API basierend auf dem Namen
        $robohashUrl = 'https://robohash.org/' . urlencode($name) . '.png?set=set2';

        // Verzeichnis für Avatare sicherstellen
        $avatarDirectory = public_path('storage/cool_avatars');
        if (!is_dir($avatarDirectory)) {
            mkdir($avatarDirectory, 0755, true);
        }

        // Dateipfad generieren
        $avatarPath = 'storage/cool_avatars/' . md5($name) . '_cool_avatar.png';
        $fullPath = public_path($avatarPath);

        // Robohash-Bild herunterladen
        $client = new Client();
        $response = $client->get($robohashUrl, ['sink' => $fullPath]);

        if ($response->getStatusCode() != 200) {
            throw new \Exception("Failed to download image from: " . $robohashUrl);
        }

        return asset($avatarPath);
    }
}
