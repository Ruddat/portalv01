<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Models\ModProductSales;
use App\Models\ModSellerVotings;
use App\Models\ModSharedTemplates;
use App\Models\ModSharedTemplateJs;
use App\Http\Controllers\Controller;
use App\Models\ModSharedTemplateCss;
use App\Models\ModSharedTemplateImages;
use App\Models\ModSharedTemplateSections;

class TemplateController extends Controller
{
    /**
     * Zeigt ein Template basierend auf dem Namen an.
     */
    public function show($templateName)
    {
        // Versuche, das Template aus der Datenbank zu holen
        $template = ModSharedTemplates::where('name', $templateName)->first();

        $shopId = 511; // Feste Shop-ID

        // Falls kein Template gefunden wurde, zeige eine Fehlerseite
        if (!$template) {
            abort(404, 'Template nicht gefunden');
        }

        // Hol die zugehörigen CSS-, JS-Daten und Sections
        $cssData = ModSharedTemplateCss::where('template_id', $template->id)->get();
        $jsData = ModSharedTemplateJs::where('template_id', $template->id)->get();
        $sections = ModSharedTemplateSections::where('template_id', $template->id)->get();

        // Hol die zugehörigen Bilder
        $images = ModSharedTemplateImages::where('template_id', $template->id)->get();

        // Hol die Bewertungen für den festen Shop
        $votings = ModSellerVotings::where('shop_id', $shopId)->get();

        // Hol die meistverkauften Produkte für den festen Shop
        $bestSellingProducts = ModProductSales::where('shop_id', $shopId)
                                ->orderBy('quantity', 'desc')
                                ->limit(5)
                                ->get();

        // Übergebe das Template, die CSS-, JS-Daten, Sections, Bewertungen, meistverkauften Produkte und Bilder an die View
        return view('templates.show', [
            'template' => $template,
            'cssData' => $cssData,
            'jsData' => $jsData,
            'sections' => $sections,
            'images' => $images, // Bilder an die View übergeben
            'votings' => $votings,
            'bestSellingProducts' => $bestSellingProducts
        ]);
    }
}
