<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class project_stage extends Model
{
    use HasFactory;

    /**
     * Assignable project_stage attributes:
     */

    protected $fillable = [
        'name',
        'description',
        'order',
        'project_id',
    ];

    public function tasks()
    {
        return $this->hasMany(stage_task::class, 'stage_id');
    }

    public function images()
    {
        return $this->hasMany(stage_image::class, 'stage_id');
    }
}
