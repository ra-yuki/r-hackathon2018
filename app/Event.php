<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    function groups(){
        return $this->belongsToMany(Group::class, 'event_group', 'eventId', 'groupId')->withTimestamps();
    }
}
