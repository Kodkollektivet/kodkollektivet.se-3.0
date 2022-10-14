<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class project extends Model
{
    use HasFactory;

    /**
     * Assignable project attributes:
     */

    protected $fillable = [
        'name',
        'user_id',
        'intro',
        'description',
        
    ];


    /* public function users()
    {
        return $this->belongsToMany(User::class, 'project_users');
    } */

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tags', 'project_id', 'tag_id');
    }

    public function stages()
    {
        return $this->hasMany(project_stage::class, 'project_id')->orderBy('order');
    }

}