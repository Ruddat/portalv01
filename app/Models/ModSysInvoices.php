<?php

namespace App\Models;

use App\Models\ModShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSysInvoices extends Model
{
    use HasFactory;

    protected $guarded = [];


        // Definieren der Beziehung zu ModShop
        public function shop()
        {
            return $this->belongsTo(ModShop::class, 'shop_id');
        }
}
