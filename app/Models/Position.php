<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'remove_posts',
        'remove_events',
        'remove_projects',
        'remove_docs',
        'create_posts',
        'create_events',
        'create_projects',
        'create_docs',
        'edit_posts',
        'edit_events',
        'edit_projects',
        'edit_docs',
        'edit_users',
        'edit_social',
        'close_accounts',
        'remove_userdata',
        'set_roles',
        'set_positions',
        'ban',
        'set_roles',
        'application_decide',
        'open'
    ];

    public function users(){
        return $this->hasMany(User::class, 'position_id', 'id');    
    }
    
    public function applications($approved = null){
        return $this->hasMany(PositionApplication::class, 'position_id', 'id')->where('approved', $approved);
    }

}
