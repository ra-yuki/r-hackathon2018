<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Event;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //  public function followings()
    // {
    //     return $this->belongsToMany(User::class,'userId', 'friendsId');
    // }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'user_friend', 'userId', 'friendId')->withTimestamps();
    }
    
    public function groups(){
        return $this->belongsToMany(Group::class, 'user_group', 'userId', 'groupId')->withTimestamps();
    }



    // public function followers()
    // {
    //     return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    // }
    
    
    public function friend($userId)
    {
    // confirm if already following
        $exist = $this->is_friend($userId);
    // confirming that it is not you
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
        // do nothing if already following
        return false;
        } else {
        // follow if not following
        $this->friends()->attach($userId);
        return true;
        }
    }

    public function unfriend($userId)
    {
    // confirming if already following
        $exist = $this->is_friend($userId);
    // confirming that it is not you
        $its_me = $this->id == $userId;


        if ($exist && !$its_me) {
        // stop following if following
        $this->friends()->detach($userId);
        return true;
        } else {
        // do nothing if not following
        return false;
        }
    }


    public function is_friend($userId) {
        return $this->friends()->where('friendId', $userId)->exists();
    }
    
}


