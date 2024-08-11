<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModSharedToolsGallerySubcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSharedToolsGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image_path',
        'subcategory_id',
        'category_id',
        'category_image_path',
        'thumbnail_path',
    ];

    // Beziehung zu ModSharedToolsGallerySubcategory
    public function category()
    {
        return $this->belongsTo(ModSharedToolsGalleryCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ModSharedToolsGalleryCategory::class, 'subcategory_id');
    }

}
