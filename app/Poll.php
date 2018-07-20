<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Link;
use App\Event;

class Poll extends Model
{
    public function links(){
        return $this->hasMany(Link::class, 'pollId');
    }
    
    public static function findFromEventPath($eventPath){
        return Poll::where('eventPath', $eventPath)->get();
    }
    
    public function getEvent(){
        return Event::where('eventPath', $this->eventPath)->first();
    }
}
