<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action_id',
        'viewed',
    ];

    public function action() {
        return $this->hasOne(user_action::class, 'id', 'action_id');    
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');    
    }
    
}
