<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModProductsIngredients extends Model
{
    use HasFactory;


    protected $guarded = [];



    protected $attributes = [
        'max_spices' => 3, // Hier setzen Sie den Standardwert auf 0
        'base_price' => 0, // Hier setzen Sie den Standardwert auf 0
    ];

}
