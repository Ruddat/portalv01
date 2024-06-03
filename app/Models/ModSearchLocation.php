<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModSearchLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'licence',
        'osm_type',
        'osm_id',
        'lat',
        'lon',
        'class',
        'type',
        'place_rank',
        'importance',
        'addresstype',
        'name',
        'display_name',
        'address',
        'boundingbox',
    ];

    protected $casts = [
        'address' => 'array',
        'boundingbox' => 'array',
    ];

}
