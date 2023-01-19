<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'company',
        'verification',
        'email_verified_at',
        'password',
        'avatar',
        'role_id',
        'board_position_id',
        'closed',               // Closed accounts cannot login.

        'remove_data',          // Marks users as avaiting data removal;
                                // action needs to be confirmed by a bord
                                // memeber or a moderator. Data and posts
                                // get hidden from general users until
                                // removal authorised / denied.

        'activity_hide'         // Hides user_action listing from non-admins.
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'session_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function online(){
        return $this->hasOne(Session::class, 'id', 'session_id')->where('last_activity', '>', strtotime('10 minutes ago'));
    }

    public function role(){
        return $this->hasOne(role::class, 'id', 'role_id');    
    }

    public function position(){
        return $this->hasOne(Position::class, 'id', 'position_id');    
    }

    public function profile(){
        return $this->hasOne(UserProfile::class);
    }

    public function posts(){
        return $this->hasMany(Post::class, 'user_id', 'id');   
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'user_id', 'id');   
    }

    public function actions($limit = 10){
        $actions = $this->hasMany(user_action::class, 'user_id', 'id')->orderBy('created_at', 'desc');

        return $limit ? $actions->take($limit) : $actions->get();
    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'user_id', 'id')->orderBy('created_at', 'desc');
    }

    public function applications(){
        return $this->hasMany(PositionApplication::class, 'user_id', 'id');
    }

    public function events(){
        return $this->belongsToMany(event::class, 'event_users');
    }

    public function projects(){
        return $this->belongsToMany(project::class, 'project_users');
    }

    public function followers(){
        return $this->belongsToMany(User::class, 'follows', 'following', 'follower');
    }

    public function following(){
        return $this->belongsToMany(User::class, 'follows', 'follower', 'following');
    }

    public function technologies($group = false){
        return $this->belongsToMany(Technology::class, 'user_technologies');
    }

}
