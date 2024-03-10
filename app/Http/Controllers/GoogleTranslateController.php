<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Services\TranslationService;

class GoogleTranslateController extends Controller
{
    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function changeLanguage(Request $request)
    {
        // Speichere die ausgewählte Sprache in der Session oder wo immer du möchtest
        session(['locale' => $request->lang]);

        // Optional: Weiterleitung zu einer anderen Seite
        //return redirect()->back();
        return redirect('/');
    }

    public function change(Request $request)
    {
        session()->put('locale', $request->lang);
  //      dd(session('locale'));
        return back();
        //return redirect('/');
    }

    public function translateText(Request $request)
    {
        $translatedText = $this->translationService->translate($request->input('text'), 'fr');

        // Weiterverarbeitung der übersetzten Texte

        return response()->json(['translatedText' => $translatedText]);
    }


}
