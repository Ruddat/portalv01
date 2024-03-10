<?php

namespace App\Models;

use App\Models\ModShop;
use App\Models\ModProducts;
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
        //return $this->belongsTo(ModShop::class, 'shop_id');
        return $this->belongsTo(ModShop::class);
    }


    public function sluggable(): array
    {
        return [
            'category_slug' => [
                'source' => ['shop.title', 'category_name'],
                'separator' => '-',
            ]
        ];
    }

    public function products()
{
    return $this->hasMany(ModProducts::class, 'category_id');
}

public function getCategoryImageUrlAttribute()
{
    $shopId = $this->shop_id; // Annahme: Das Shop-ID-Attribut im Modell ist 'shop_id'

    if ($this->category_image) {
        return asset('uploads/shops/' . $shopId . '/images/category/' . $this->category_image);
    } else {
        return asset('uploads/images/default/logo.png'); // Hier solltest du den Pfad zum Standardbild anpassen
    }
}


protected static function boot()
{
    parent::boot();

    static::deleting(function ($category) {
        // Löschen der zugehörigen Produkte
        $category->products()->delete();
    });
}





}
