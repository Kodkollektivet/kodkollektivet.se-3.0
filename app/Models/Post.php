<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    /**
     * Assignable post attributes:
     */

    protected $fillable = [
        'name',
        'user_id',
        'community',
        'image',
        'intro',
        'description'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(image::class, 'item_id', 'id')->where('item_type', 'post');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'item_id', 'id')->where('item_type', 'post')->orderBy('created_at', 'desc');
    }

}
