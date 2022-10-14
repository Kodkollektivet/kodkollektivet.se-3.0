<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DeleteLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action_id',
        'item'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');    
    }
}
