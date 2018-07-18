<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Link;
use App\Event;

class Poll extends Model
{
    public function links(){
        return $this->hasMany(Link::class, 'pollId')->get();
    }
    
    public function event(){
        return Event::where('eventPath', $this->eventPath)->first();
    }
}
