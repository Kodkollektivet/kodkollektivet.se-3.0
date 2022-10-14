<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;

    /**
     * Assignable event attributes:
     */

    protected $fillable = [
        'content',
        'user_id',
        'item_id',
        'item_type',
        'origin'
    ];

    public function author() {
        return $this->hasOne(User::class, 'id', 'user_id');    
    }

    public function threadStart() {
        return $this->hasOne(Comment::class, 'id', 'origin');
    }

    public function parent() {
        return $this->hasOne(Comment::class, 'id', 'item_id');    
    }

    public function replies() {
        return $this->hasMany(Comment::class, 'item_id', 'id')->where('item_type', 'comment')->orderBy('created_at', 'asc');   
    }

    public function threadDepth($depth = null) {
        !isset($depth) ? $depth = $this->replies->count() : $depth += $this->replies->count();

        foreach ($this->replies as $reply) {
            $depth = $reply->threadDepth($depth);
        }

        return $depth;
    }
}
