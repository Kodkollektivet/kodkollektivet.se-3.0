<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_ansver extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'question_id'
    ];
}
