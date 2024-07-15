<?php

namespace App\Http\Controllers\MobileApp;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManifestController extends Controller
{
    public function index(Request $request, $shopSlug)
    {
        // Logge die extrahierte Shop-Slug-Information
        Log::info('Manifest.json aufgerufen für Shop-Slug: ' . $shopSlug);

        // Hier könntest du die Shop-ID anstelle des Slugs verwenden, falls notwendig
        // $shopId = ...; // Extrahiere die Shop-ID hier, falls du sie benötigst

        return response()->json([
            "name" => "Dein App-Name",
            "short_name" => "App",
            "start_url" => url('/shop/' . $shopSlug),
            "display" => "standalone",
            "background_color" => "#ffffff",
            "theme_color" => "#000000",
            "icons" => [
                [
                    "src" => asset('frontend/img/apple-touch-icon-57x57-precomposed.png'),
                    "sizes" => "57x57",
                    "type" => "image/png"
                ],
                [
                    "src" => asset('frontend/img/apple-touch-icon-114x114-precomposed.png'),
                    "sizes" => "114x114",
                    "type" => "image/png"
                ]
            ]
        ]);
    }
}
