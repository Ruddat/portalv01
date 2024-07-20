<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RobotsController extends Controller
{
    public function index()
    {
        $content = "User-agent: *\n";
        $content .= "Disallow: \n";
        $content .= "Sitemap: " . url('/sitemap.xml');

        return response($content, 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
