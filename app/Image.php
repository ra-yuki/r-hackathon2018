<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Event;

class Image extends Model
{
    public function user(){
        return $this->belongsTo('App\User', 'userId');
    }
    
    public function events(){
        $events = Event::where('eventPath', $this->eventPath)->get();
        return $events;
    }
    
    public function event(){
        $event = Event::where('eventPath'. $this->eventPath)->first();
        return $event;
    }
    
    public function group(){
        return $this->belongsTo('App\Group', 'groupId');
    }
    
    public function deleteAllExceptDefaultImages(){
        Image::where('userId', '<>', null)->delete();
    }
}
