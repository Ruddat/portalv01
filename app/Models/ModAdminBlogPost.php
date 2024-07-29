<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModAdminBlogPost extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'content',
        'image_original',
        'image_large',
        'image_medium',
        'image_thumbnail',
        'category_id',
        'user_id',
        'start_date',
        'slug'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'separator' => '-',
                'unique' => true,
            ]
        ];
    }

    // Beziehung zum Admin-Modell (Autor des Blog-Posts)
    public function author()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(ModAdminBlogCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(ModAdminBlogTag::class, 'mod_admin_post_tag', 'post_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id'); // Referencing the Admin model
    }

    public function comments()
    {
        return $this->hasMany(ModAdminBlogComment::class, 'post_id');
    }


}
