<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class stage_task extends Model
{
    use HasFactory;

    /**
     * Assignable stage_task attributes:
     */

    protected $fillable = [
        'name',
        'description',
        'stage_id',
        'done',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'member_tasks', 'task_id', 'user_id');
    }
}
