<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPromoBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'icon', 'coupon_code', 'start_time', 'end_time', 'banner_color',
    ];


}
