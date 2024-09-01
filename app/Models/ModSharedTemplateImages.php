<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModSharedTemplateImages extends Model
{
    use HasFactory;

    protected $fillable = ['template_id', 'file_path'];

    public function template()
    {
        return $this->belongsTo(ModSharedTemplates::class, 'template_id');
    }


}
