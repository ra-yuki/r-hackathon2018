<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Poll;
use App\User;
use App\Event;

class Link extends Model
{
    //*-- user_link intermediate table stuffs --*//
    public function users(){
        return $this->belongsToMany(User::class, 'user_link', 'linkId', 'userId')->withTimestamps();
    }
    
    public function poll(){
        return $this->belongsTo(Poll::class, 'pollId');
    }
    
    public static function bulkSaveAndRegisterAsPoll($links, $title, $eventPath){
        // store poll record for connecting event and links
        $poll = new Poll();
        $poll->title = $title;
        $poll->eventPath = $eventPath;
        $saved = $poll->save();
        // exception handling
        if(!$saved) return false;
        
        foreach($links as $l){
            $l->pollId = $poll->id;
            
            $saved = $l->save();
            // exception handling
            if(!$saved) return false;
        }
        
        return true;
    }
}
