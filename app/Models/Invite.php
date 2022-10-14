<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Invite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sent_to',
        'accepted'
    ];

    public function author() {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');    
    }
    
}
