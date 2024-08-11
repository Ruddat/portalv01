<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModSharedToolsGallerySubcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSharedToolsGalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Beziehung zu ModSharedToolsGallerySubcategory
    public function subcategories()
    {
        return $this->hasMany(ModSharedToolsGallerySubcategory::class, 'category_id');
    }

}
