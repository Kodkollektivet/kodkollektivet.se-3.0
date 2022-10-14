<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Technology extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'icon',
        'type'
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_technologies')->orderBy('type');
    }

}
