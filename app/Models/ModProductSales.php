<?php

namespace App\Models;

use App\Models\ModProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModProductSales extends Model
{
    use HasFactory;

    protected $guarded = [];



    // Beziehung zum ModProducts Modell
    public function product()
    {
        return $this->belongsTo(ModProducts::class, 'product_id');
    }
}
