<?php

namespace App\Models;

use App\Models\ModShop;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModCategory extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];


    public function shop()
    {
        return $this->belongsTo(ModShop::class);
    }


    public function sluggable(): array
    {
        return [
            'category_slug' => [
                'source' => 'category_name',
            ]
        ];
    }
}
