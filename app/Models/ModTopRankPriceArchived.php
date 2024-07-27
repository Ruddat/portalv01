<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModTopRankPriceArchived extends Model
{
    use HasFactory;

    protected $table = 'mod_top_rank_price_archiveds';
    protected $fillable = [
        'shop_id', 'current_price', 'lat', 'lng', 'rank', 'start_time', 'end_time', 'deleted_at'
    ];
    

}
