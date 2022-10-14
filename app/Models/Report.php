<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'item_id',
        'item_type',
        'type',
        'content',
        'resolved'
    ];

    public function author() {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');    
    }

}
