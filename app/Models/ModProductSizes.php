<?php

namespace App\Models;

use App\Models\ModProducts;
use App\Models\ModProductSizes;
use App\Models\ModProductSizesPrices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModProductSizes extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
{
    return $this->belongsTo(ModProducts::class);
}

public function price()
{
//    return $this->hasMany(ModProductSizesPrices::class, 'product_size_id');
    return $this->hasMany(ModProductSizesPrices::class, 'size_id', 'id');
   // return $this->hasMany(ModProductSizesPrices::class, 'size_id', 'size_id');


}

    public function children()
    {
        return $this->hasMany(ModProductSizes::class, 'parent');
    }

}
