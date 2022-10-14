<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class event extends Model
{
    use HasFactory;

    /**
     * Assignable event attributes:
     */

    protected $fillable = [
        'name',
        'type',
        'user_id',
        'image',
        'intro',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_users');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'event_tags');
    }

    public function images()
    {
        return $this->hasMany(image::class, 'item_id', 'id')->where('item_type', 'event');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'item_id', 'id')->where('item_type', 'event')->orderBy('created_at', 'desc');
    }
    
}
