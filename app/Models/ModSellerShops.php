<?php

namespace App\Models;

use App\Models\Seller;
use App\Models\ModShop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSellerShops extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function shop()
    {
        return $this->belongsTo(ModShop::class);
    }


}
