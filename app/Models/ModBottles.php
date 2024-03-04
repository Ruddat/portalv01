<?php

namespace App\Models;

use App\Models\ModProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModBottles extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function product()
{
    return $this->belongsTo(ModProducts::class);
}


}
