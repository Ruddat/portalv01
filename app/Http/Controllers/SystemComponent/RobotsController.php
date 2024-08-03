<?php

namespace App\Http\Controllers\SystemComponent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
