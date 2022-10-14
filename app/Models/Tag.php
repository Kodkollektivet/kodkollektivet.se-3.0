<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    use HasFactory;

    /**
     * Assignable tag attributes:
     */

    protected $fillable = [
        'name'
    ];

    public function projects()
    {
        return $this->belongsToMany(project::class, 'project_tags');
    }
}
