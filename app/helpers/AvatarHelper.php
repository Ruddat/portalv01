<?php

namespace App\Helpers;

class AvatarHelper
{
    public static function createAvatar($name)
    {
        // Verzeichnis für Avatare sicherstellen
        $avatarDirectory = public_path('storage/avatars');
        if (!is_dir($avatarDirectory)) {
            mkdir($avatarDirectory, 0755, true);
        }

        $words = explode(' ', $name);
        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1] ?? '', 0, 1));

        // Define a background color and text color for the avatar
        $bgColor = '#'.substr(md5($name), 0, 6); // Use a unique color based on the name
        $textColor = '#ffffff'; // White text color

        // Create an image with the initials and colors
        $imageSize = 68;
        $image = imagecreate($imageSize, $imageSize);
        $bg = imagecolorallocate($image, hexdec(substr($bgColor, 1, 2)), hexdec(substr($bgColor, 3, 2)), hexdec(substr($bgColor, 5, 2)));
        $text = imagecolorallocate($image, hexdec(substr($textColor, 1, 2)), hexdec(substr($textColor, 3, 2)), hexdec(substr($textColor, 5, 2)));
        imagefill($image, 0, 0, $bg);

        // Set font path and size
        $fontPath = public_path('extra-assets/fonts/arial/ARIAL.TTF');
        $fontSize = 30; // Adjust font size to fit within 68x68

        // Calculate text box size
        $bbox = imagettfbbox($fontSize, 0, $fontPath, $initials);
        $textWidth = $bbox[2] - $bbox[0];
        $textHeight = $bbox[1] - $bbox[7]; // bbox[1] is bottom, bbox[7] is top

        // Calculate the position to center the text
        $x = ($imageSize - $textWidth) / 2;
        $y = ($imageSize - $textHeight) / 2 - $bbox[7]; // Adjust y by the top part of the text bounding box

        // Add text to the image
        imagettftext($image, $fontSize, 0, $x, $y, $text, $fontPath, $initials);

        // Save the image to a file
        $avatarPath = 'storage/avatars/'.md5($name).'_avatar.png';
        $fullPath = public_path($avatarPath);
        if (!imagepng($image, $fullPath)) {
            imagedestroy($image);
            throw new \Exception("Failed to save image to: " . $fullPath);
        }

        imagedestroy($image);

        return asset($avatarPath);
    }
}
