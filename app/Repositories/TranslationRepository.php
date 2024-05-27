<?php



namespace App\Repositories;

use App\Models\Translation;

class TranslationRepository
{
    public function findTranslation($key, $locale)
    {
        return Translation::where('key', $key)
                          ->where('locale', $locale)
                          ->first();
    }

    public function saveTranslation($key, $locale, $text)
    {
        return Translation::updateOrCreate(
            ['key' => $key, 'locale' => $locale],
            ['text' => $text]
        );
    }
}
