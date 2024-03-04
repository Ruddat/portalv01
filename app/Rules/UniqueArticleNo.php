<?php

namespace App\Rules;

use Closure;
use App\Models\ModProducts;
use Illuminate\Contracts\Validation\Rule;


class UniqueArticleNo implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Wenn das Feld leer ist, wird die Validierung als erfolgreich betrachtet
        if (empty($value)) {
            return true;
        }

        // Überprüfen, ob ein Produkt mit der gleichen Artikelnummer für denselben Shop vorhanden ist
        $product = ModProducts::where('product_code', $value)
            ->where('shop_id', request()->input('shop_id'))
            ->first();

        // Die Regel ist nur erfüllt, wenn kein Produkt mit derselben Artikelnummer gefunden wurde
        return $product === null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute has already been taken for this shop.';
    }
}
