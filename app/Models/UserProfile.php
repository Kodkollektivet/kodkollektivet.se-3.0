<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'about',
        'cover',
        'phone',
        'discord',
        'github',
        'facebook',
        'linkedin',
        'website',
        'campus',
        'programme',
        'LOE',
        'year',
        'date_started',
        'date_ended',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');    
    }
}
