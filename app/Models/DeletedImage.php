<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DeletedImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'author_id',
        'log_id',
        'src'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');    
    }

    public function author() {
        return $this->hasOne(User::class, 'id', 'author_id');    
    }

    public function log() {
        return $this->hasOne(DeleteLog::class, 'id', 'log_id'); 
    }

}
