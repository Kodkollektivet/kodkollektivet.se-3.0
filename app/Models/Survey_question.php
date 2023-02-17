<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey_question extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'type',
        'options',
        'survey_id'
    ];

    public function ansvers(){
        return $this->hasMany(Question_ansver::class, 'question_id', 'id');    
    }

}
