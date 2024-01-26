<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryArea extends Model
{
    use HasFactory;


    protected $fillable = [
        'shop_id',
        'distance_km',
        'delivery_cost',
        'delivery_charge',
        'free_delivery_threshold',
        'latitude',
        'longitude',
        'radius',
        'color'
        // Weitere Attribute je nach Bedarf
    ];
}
