<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModCategory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function shop()
    {
        return $this->belongsTo(ModShop::class);
    }
}