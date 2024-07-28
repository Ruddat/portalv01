<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModAdminBlogTag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(ModAdminBlogPost::class, 'mod_admin_post_tag', 'tag_id', 'post_id');
    }
}
