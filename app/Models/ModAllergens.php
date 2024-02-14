<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModAllergens extends Model
{
    use HasFactory;
    use Sluggable;


    protected $guarded = [];


    public function sluggable(): array
    {
        return [
            'allergenic_slug' => [
                'source' => 'allergenic_short_title',
            ]
        ];
    }
}
