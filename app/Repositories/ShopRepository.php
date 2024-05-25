<?php

namespace App\Repositories;

use App\Models\ModShop;

class ShopRepository
{
    public static function findById($id)
    {
        return ModShop::findOrFail($id);
    }

    // Weitere Methoden für Datenbankoperationen mit Shops können hier hinzugefügt werden
}
