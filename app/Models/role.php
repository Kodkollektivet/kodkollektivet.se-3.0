<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class role extends Model
{
    use HasFactory;

    /**
     * Assignable role attributes:
     */

    protected $fillable = [
        'comment',
        'post',
        'apply_positions',
        'assign',
        'h_comment',
        'h_post',
        'h_comment_lim',
        'h_post_lim',
    ];

    public function users(){
        return $this->hasMany(User::class, 'role_id', 'id');    
    }

}
