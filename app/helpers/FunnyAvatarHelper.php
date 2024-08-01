<?php

namespace App\Helpers;

class FunnyAvatarHelper
{
    public static function createFunnyAvatar($name)
    {
        // Verzeichnis für Avatare sicherstellen
        $avatarDirectory = public_path('storage/funny_avatars');
        if (!is_dir($avatarDirectory)) {
            mkdir($avatarDirectory, 0755, true);
        }

        // Define avatar size
        $imageSize = 68;
        $image = imagecreate($imageSize, $imageSize);

        // Generate random background color
        $bgColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imagefill($image, 0, 0, $bgColor);

        // Generate random face color
        $faceColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));

        // Draw face (simple circle for smiley face)
        $centerX = $imageSize / 2;
        $centerY = $imageSize / 2;
        $radius = $imageSize / 3;

        imagefilledellipse($image, $centerX, $centerY, $radius * 2, $radius * 2, $faceColor);

        // Draw eyes (two small circles)
        $eyeColor = imagecolorallocate($image, 0, 0, 0);
        $eyeSize = $radius / 4;
        imagefilledellipse($image, $centerX - $eyeSize, $centerY - $eyeSize, $eyeSize, $eyeSize, $eyeColor);
        imagefilledellipse($image, $centerX + $eyeSize, $centerY - $eyeSize, $eyeSize, $eyeSize, $eyeColor);

        // Draw mouth (simple arc)
        $mouthColor = imagecolorallocate($image, 255, 0, 0);
        imagearc($image, $centerX, $centerY + $eyeSize, $radius, $radius / 2, 0, 180, $mouthColor);

        // Save the image to a file
        $avatarPath = 'storage/funny_avatars/' . md5($name) . '_funny_avatar.png';
        $fullPath = public_path($avatarPath);
        if (!imagepng($image, $fullPath)) {
            imagedestroy($image);
            throw new \Exception("Failed to save image to: " . $fullPath);
        }

        imagedestroy($image);

        return asset($avatarPath);
    }
}
