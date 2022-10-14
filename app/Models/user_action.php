<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class user_action extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'item_id',
        'item_type',
        'action'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');    
    }

    public function deleteLog(){
        return $this->hasOne(DeleteLog::class, 'action_id', 'id');
    }
}
