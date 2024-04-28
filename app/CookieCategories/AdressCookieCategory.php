<?php

namespace App\CookieCategories;

use Whitecube\LaravelCookieConsent\Contracts\CookieCategoryContract;

class AdressCookieCategory implements CookieCategoryContract
{
    /**
     * Get the cookie category's key
     *
     * @return string
     */
    public function getKey(): string
    {
        return 'adress'; // Eindeutiger Schlüssel für die Kategorie
    }

    /**
     * Get the cookie category's name
     *
     * @return string
     */
    public function getName(): string
    {
        return __('Adress Cookies'); // Name der Kategorie, der in der Zustimmungsanzeige angezeigt wird
    }

    /**
     * Get the cookie category's description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return __('Cookies used for analytics purposes'); // Beschreibung der Kategorie, die in der Zustimmungsanzeige angezeigt wird
    }

    /**
     * Check if the category is essential and should always be loaded
     *
     * @return bool
     */
    public function isEssential(): bool
    {
        return false; // Festlegen, ob die Kategorie essentiell ist (true) oder nicht (false)
    }
}
