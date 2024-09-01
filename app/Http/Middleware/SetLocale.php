<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1); // Erstes Segment der URL, das die Sprache enthält
        $availableLocales = config('app.available_locales'); // Die konfigurierten Sprachen

        if (in_array($locale, $availableLocales)) {
            App::setLocale($locale); // Setzt die Sprache der Anwendung
            session()->put('locale', $locale); // Speichert die Sprache in der Session
        } else {
            // Fallback auf die Session, wenn das locale nicht in der URL vorhanden oder ungültig ist
            $locale = session()->get('locale', config('app.locale'));
            App::setLocale($locale);
        }

        return $next($request);
    }
}
