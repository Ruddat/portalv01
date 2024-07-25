<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModTopRankPrice extends Model
{
    use HasFactory;


    protected $table = 'mod_top_rank_prices';

    // Dies schützt keine Felder, sodass alle im Model verfügbar sind
    protected $guarded = [];


}
