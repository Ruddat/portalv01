<?php

namespace App\Http;

class Breadcrumbs
{
    public static function generate($items)
    {
        // Hol die verfügbaren Locales aus der Konfiguration
        $availableLocales = config('app.available_locales');

        // Hol das aktuelle Locale
        $locale = app()->getLocale();
        //dd($availableLocales, $locale); // Debugging

        // Verifiziere, ob das aktuelle Locale in den verfügbaren Locales existiert
        if (!in_array($locale, $availableLocales)) {
            // Fallback auf ein Standardlocale, falls das aktuelle nicht in der Liste ist
            $locale = 'en'; // oder setze auf eine andere Standard-Sprache
        }

        $breadcrumbs = '<nav aria-label="breadcrumb">';
        $breadcrumbs .= '<ol class="breadcrumb">';

        foreach ($items as $item) {
            if (isset($item['url'])) {
                // Überprüfe, ob die URL eine relative URL ist und füge das Locale hinzu, wenn es noch nicht enthalten ist
                if (!preg_match('/^(http|https):\/\//', $item['url']) && strpos($item['url'], $locale) === false) {
                    $urlWithLocale = url($locale . '/' . ltrim($item['url'], '/'));
                    //dd($urlWithLocale); // Debugging
                } else {
                    $urlWithLocale = $item['url'];
                }

                $breadcrumbs .= '<li class="breadcrumb-item"><a href="' . $urlWithLocale . '">' . $item['label'] . '</a></li>';
            } else {
                $breadcrumbs .= '<li class="breadcrumb-item active" aria-current="page">' . $item['label'] . '</li>';
            }
        }

        $breadcrumbs .= '</ol>';
        $breadcrumbs .= '</nav>';
        //dd($breadcrumbs); // Debugging

        return $breadcrumbs;
    }
}
