<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Event;
use App\User;

class Link extends Model
{
    //*-- user_link intermediate table stuffs --*//
    public function users(){
        return $this->belongsToMany(User::class, 'user_link', 'userId', 'linkId')->withTimestamps();
    }
    
    //*-- event_link intermediate table stuffs --*//
    public function events(){
        return $this->belongsToMany(Event::class, 'event_link', 'eventId', 'linkId')->withTimestamps();
    }
    
    //*-- others --*//
    // public static function getPollLinks($pollPath){
    //     return Link::where('pollPath', $pollPath)->orderBy('created_at')->get();
    // }
    
    // public function bulkSave($links, $pollTitle){
    //     $pollPath = OctopathHelper::generate_octopath();
        
    //     foreach($links as $link){
    //         $link->pollPath = $pollPath;
    //         $link->pollTitle =$pollTitle;
    //         $saved = $link->save();
            
    //         if(!$saved) return false;
    //     }
        
    //     return true;
    // }
}
