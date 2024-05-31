<?php

namespace App\Services;

use App\Repositories\TranslationRepository;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;


class AutoTranslationService
{
    protected $translationRepository;
    protected $googleTranslate;

    public function __construct(TranslationRepository $translationRepository)
    {
        $this->translationRepository = $translationRepository;
        $this->googleTranslate = new GoogleTranslate();
    }

    public function trans($key, $locale)
    {
      //  Log::info("Request to translate '$key' to '$locale'.");

        // Suche die Übersetzung in der Datenbank
        $translation = $this->translationRepository->findTranslation($key, $locale);

        // Falls die Übersetzung vorhanden ist, zurückgeben
        if ($translation) {
            Log::info("Translation found in database: '$translation->text'");
            return $translation->text;
        }

        // Falls nicht vorhanden, Übersetzung über Google Translate erstellen und speichern
        $translatedText = $this->translateAndSave($key, $locale);

        // Rückgabe der erstellten Übersetzung
        Log::info("Translated text: '$translatedText'");
        return $translatedText;
    }

    protected function translateAndSave($key, $locale)
    {
        try {
            Log::info("Translating via Google Translate: '$key' to '$locale'");

            // Setze die Ziel- und Ausgangssprache für die Übersetzung
            $this->googleTranslate->setTarget($locale);
            $this->googleTranslate->setSource(config('app.fallback_locale', 'de'));

            // Füge die Übersetzungsaufgabe zur Warteschlange hinzu
            Queue::push(function () use ($key, $locale) {
                // Übersetze den Schlüssel
                $translatedText = $this->googleTranslate->translate($key);

                // Logge die Übersetzung für Debugging-Zwecke
                Log::info("Translated '$key' to '$translatedText' for locale '$locale'.");

                // Speichere die Übersetzung in der Datenbank
                $this->translationRepository->saveTranslation($key, $locale, $translatedText);
            });

            // Rückgabe des ursprünglichen Schlüssels
            return $key;
        } catch (\Exception $e) {
            // Logge den Fehler und verwende den Schlüssel als Fallback
            Log::error("Translation failed: " . $e->getMessage());
            return $key;
        }
    }


    public function addTranslation($key, $locale, $text)
    {
        // Speichere die Übersetzung in der Datenbank
        return $this->translationRepository->saveTranslation($key, $locale, $text);
    }
}
