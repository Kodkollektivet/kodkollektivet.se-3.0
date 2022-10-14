<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class stage_image extends Model
{
    use HasFactory;

    /**
     * Assignable image attributes:
     */

    protected $fillable = [
        'src',
        'alt',
        'stage_id'
    ];
}
