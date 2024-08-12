<?php

namespace App\Models;

use App\Models\ModSharedToolsGallery;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModSharedToolsGalleryCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSharedToolsGallerySubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
    ];

    // Beziehung zu ModSharedToolsGalleryCategory
    public function category()
    {
        return $this->belongsTo(ModSharedToolsGalleryCategory::class, 'category_id');
    }

    // Beziehung zu ModSharedToolsGallery
    public function galleryItems()
    {
        return $this->hasMany(ModSharedToolsGallery::class, 'subcategory_id');
    }

}
