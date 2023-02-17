<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'open',
        'user_id'
    ];

    public function author(){
        return $this->hasOne(User::class, 'id', 'user_id');    
    }

    public function questions(){
        return $this->hasMany(Survey_question::class, 'survey_id', 'id');    
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'Survey_user');
    }

}
