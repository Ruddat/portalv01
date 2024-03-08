<?php

namespace App\Models;

use App\Models\ModProducts;
use App\Models\ModProductSizes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModProductSizesPrices extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productSize()
    {
        return $this->belongsTo(ModProductSizes::class, 'size_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(ModProducts::class, 'parent', 'id');
    }


    public function size()
    {
        return $this->belongsTo(ModProductSizes::class, 'size_id', 'id');
    }
}
