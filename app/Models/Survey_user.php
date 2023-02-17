<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'user_id'
    ];
    
}
