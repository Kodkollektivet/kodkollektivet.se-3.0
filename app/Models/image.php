<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class image extends Model
{
    use HasFactory;

    /**
     * Assignable image attributes:
     */

    protected $fillable = [
        'src',
        'alt',
        'item_id',
        'item_type',
        'cover'
    ];

    public function post() {
        return $this->hasOne(Post::class, 'id', 'item_id');    
    }

    public function event() {
        return $this->hasOne(event::class, 'id', 'item_id');    
    }

    public function project() {
        return $this->hasOne(project::class, 'id', 'item_id');    
    }
    
}
