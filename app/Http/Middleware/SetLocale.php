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
        // Lade die verfügbaren Sprachen aus der Konfigurationsdatei
        $availableLocales = array_values(config('app.available_locales'));

        // Das erste Segment der URL, z.B. 'en' oder 'de'
        $locale = $request->segment(1);

        // Überprüfen, ob das `locale` in der Konfiguration vorhanden ist
        if (in_array($locale, $availableLocales)) {
            app()->setLocale($locale);
            session()->put('locale', $locale); // Das Locale auch in der Session speichern
        } else {
            // Fallback auf die Session, falls das Locale nicht in der URL ist
            $locale = session()->get('locale', config('app.locale'));
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
