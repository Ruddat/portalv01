<?php

namespace App\Models;

use App\Models\ModSharedTemplateJs;
use App\Models\ModSharedTemplateCss;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModSharedTemplateSections;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSharedTemplates extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cssFiles()
    {
        return $this->hasMany(ModSharedTemplateCss::class, 'template_id');
    }

    public function jsFiles()
    {
        return $this->hasMany(ModSharedTemplateJs::class, 'template_id');
    }

    public function sections()
    {
        return $this->hasMany(ModSharedTemplateSections::class, 'template_id');
    }
    public function images()
    {
        return $this->hasMany(ModSharedTemplateImages::class, 'template_id');
    }

}
