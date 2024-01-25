<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    protected $translator;

    public function __construct(GoogleTranslate $translator)
    {
        $this->translator = $translator;
    }

    public function translate($text, $targetLanguage)
    {
        $cacheKey = 'translation_' . md5($text . $targetLanguage);

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($text, $targetLanguage) {
            $this->translator->setSource('auto');
            $this->translator->setTarget($targetLanguage);

            return $this->translator->translate($text);
        });
    }

    public function trans($text, $targetLanguage)
{
    return $this->translate($text, $targetLanguage);
}

}
