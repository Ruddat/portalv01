<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModAdminBlogCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Beziehung zu Blog-Posts
    public function posts()
    {
        return $this->hasMany(ModAdminBlogPost::class, 'category_id');
    }


}
