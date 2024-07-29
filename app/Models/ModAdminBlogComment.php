<?php

namespace App\Models;

use App\Models\ModAdminBlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModAdminBlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'author',
        'email',
        'content',
        'parent_id',
        'approved',
        'verification_token',
        
    ];

    public function post()
    {
        return $this->belongsTo(ModAdminBlogPost::class);
    }

    public function replies()
    {
        return $this->hasMany(ModAdminBlogComment::class, 'parent_id')->latest();
    }


}
