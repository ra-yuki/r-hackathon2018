<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Event;
use App\Libraries\GeneralHelper;

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
    
    public function friendeds(){
        return $this->belongsToMany(User::class, 'user_friend','friendId' ,'userId')->withTimestamps();
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
        // friend back
        User::find($userId)->friends()->attach($this->id);
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
    
    //*-- regarding images table --*//
    public function images(){
        return $this->hasMany('App\Image', 'userId');
    }
    
    public function image(){
        return $this->hasOne('App\Image', 'userId');
    }
    
    //*-- groups table stuffs --*//
    public function groups(){
        return $this->belongsToMany(Group::class, 'user_group', 'userId', 'groupId')->withTimestamps();
    }
    
    //*-- other helper functions --*//
    
    // param $exceptions: Event array
    // return $res: Array
    //      ex. [Event, ...]
    public function getEventsAll($exceptions = null){
        $res = [];// array to return
        
        // get where clause template
        $wheres = [];
        if(isset($exceptions)){
            foreach($exceptions as $exception){
                $where = ['eventPath', '<>', $exception->eventPath];
                array_push($wheres, $where);
            }
        }
        
        $groups = $this->groups;
        foreach($groups as $g){
            $events = isset($exceptions) ? $g->events()->where($wheres)->get() : $g->events;
            $res = array_merge($res, GeneralHelper::collection2Array($events));
        }
        
        return $res;
    }
    
    public function getEventsAllAsCollection($exceptions = null){
        return collect($this->getEventsAll($exceptions));
    }
    
    public function getEventsAllAsTimestamps($exceptions = null){
        $events = $this->getEventsAll($exceptions);
        
        $c = count($events);
        for($i=0; $i<$c; $i++){
            $events[$i] = Event::eventDateTimeSelf2Timestamps($events[$i]);
        }
        
        return $events;
    }
}


