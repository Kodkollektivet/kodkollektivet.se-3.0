<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PositionApplication extends Model
{
    use HasFactory;


    protected $fillable = [
        'position_id',
        'user_id',
        'message',
        'reply',
        'approved'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }

}
