<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModAdditives extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];


    public function sluggable(): array
    {
        return [
            'additive_slug' => [
                'source' => 'additive_title'
            ]
        ];
    }


}
