<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

use App\Image;
use App\Group;
use App\Poll;
use App\Libraries\Vec2;
use App\Libraries\GeneralHelper;
use App\Libraries\Config;
use App\Libraries\OctopathHelper;

class Event extends Model
{
    //////////////////////////////////////////////////
    //*-- groups table stuffs --*
    //////////////////////////////////////////////////
    function groups(){
        return $this->belongsToMany(Group::class, 'event_group', 'eventId', 'groupId')->withTimestamps();
    }
    
    //////////////////////////////////////////////////
    //*-- images table stuff --*//
    //////////////////////////////////////////////////
    function images(){
        $images = Image::where('eventPath', $this->eventPath)->get();
        return $images;
    }
    
    function image(){
        $images = Image::where('eventPath', $this->eventPath)->first();
        return $images;
    }
    
    //////////////////////////////////////////////////
    //*-- polls table stuff --*//
    //////////////////////////////////////////////////
    public function polls(){
        return Poll::where('eventPath', $this->eventPath)->get();
    }
    
    //////////////////////////////////////////////////
    //*-- scheduling --*//
    //////////////////////////////////////////////////
    
    //------------------------------
    //@main functions
    //------------------------------
    public static function getSchedulablesWithGroup(Event $plan, Group $group, $exceptions = null){
        // Get from&to pair for each date options as array
        $options = Event::getOptionsAll($plan);
        \Debugbar::info('$options');
        \Debugbar::info($options);
        // Get each users' events in the group
        $memberEvents = Event::getMemberEventsAll($group, $exceptions);
        \Debugbar::info('$memberEvents');
        \Debugbar::info($memberEvents);
        
        // Get availability status of each date options
        $availabilities = Event::getAvailabilitiesAll($options, $memberEvents);
        
        \Debugbar::info('$availabilities');
        \Debugbar::info($availabilities);
        
        return $availabilities;
    }
    
    public static function getBestSchedulablesWithGroup(Event $plan, Group $group, $exceptions = null){
        // Get from&to pair for each date options as array
        $options = Event::getOptionsAll($plan);
        \Debugbar::info('$options');
        \Debugbar::info($options);
        // Get each users' events in the group
        $memberEvents = Event::getMemberEventsAll($group, $exceptions);
        \Debugbar::info('$memberEvents');
        \Debugbar::info($memberEvents);
        
        // Get availability status of each date options
        $availabilities = Event::getAvailabilitiesAll($options, $memberEvents);
        
        \Debugbar::info('$availabilities');
        \Debugbar::info($availabilities);
        
        // Get the most favourable options
        $favourables = Event::getMostFavourables($availabilities);
        
        return $favourables;
    }
    
    public static function saveSchedulablesWithGroup(Event $plan, Group $group, Request $request, $schedulables){
        if(!isset($request->title)) return false; // exception handling
        
        // set NOT nullables
        $plan->title = $request->title;
        $plan->eventPath = OctopathHelper::generate_octopath();
        $plan->fixed = false;
        
        // set nullables
        $plan->location = (isset($request->location)) ? $request->location : null;
        $plan->description = (isset($request->description)) ? $request->description : null;
        // $plan->linkId = (isset($request->linkId)) ? $request->linkId : null; //might not be appropriate here
        
        foreach($schedulables as $schedulable){
            $event = clone $plan;
            $event->dateTimeFromSelf = date(Config::DATETIME_FORMAT_FULL, $schedulable->from);
            $event->dateTimeToSelf = date(Config::DATETIME_FORMAT_FULL, $schedulable->to);
            
            if(!$event->save()) return false;
            
            $group->subscribeEvent($event->id);
        }
        
        return $plan->eventPath;
    }
    
    //------------------------------
    //@sub functions
    //------------------------------
    public static function fetchAvailables($schedulables, $eventsFetchedTo){
        $res = [];
        
        foreach($eventsFetchedTo as $e){
            $eTs = Event::eventDateTimeSelf2Timestamps($e);
            foreach($schedulables as $schedulable){
                $cond = ($eTs->from == $schedulable->from) &&
                        ($eTs->to == $schedulable->to);
                
                if(!$cond) continue; // exception handling
                
                $e->availables = $schedulable->availables;
                array_push($res, $e);
            }
        }
        
        return $res;
    }
    
    public static function retrieveFromSchedulables($schedulables, $subjects){
        $res = [];
        
        foreach($subjects as $subject){
            $subjectTs = Event::eventDateTimeSelf2Timestamps($subject);
            foreach($schedulables as $schedulable){
                $cond = ($subjectTs->from == $schedulable->from) &&
                        ($subjectTs->to == $schedulable->to);
                
                if(!$cond) continue; // exception handling
                
                array_push($res, $schedulable);
            }
        }
        
        if(count($res) == 0) return false; // exception handling
        
        return $res;
    }
    
    public static function getMostFavourables($availabilities){
        // retrieve count of availables property
        $favourables = [];
        $max = 0;
        foreach($availabilities as $i => $availability){
            $c = count($availability->availables);
            
            if($c > $max){ //refresh if more than max
                $max = $c; //update max val
                $favourables = []; //init
            }
            else if( ($c < $max) || ($c == 0) ){ //skip if NOT max
                continue;
            }
            
            array_push($favourables, $availability);
        }
        
        if(count($favourables) == 0) return false;
        
        return $favourables;
    }
    
    // return $options: Array
    //          ex. [0 => [
    //              'from': (timestamp),
    //              'to': (timestamp)
    //              ]]
    public static function getOptionsAll(Event $plan){
        $res = []; // array to return
        
        // parse from and to pair of each option to $res
        $fromTo = Event::eventDateTimeOption2DateTimes($plan);
        $diff = $fromTo->from->diff($fromTo->to)->days;
        for($i=0; $i<$diff+1; $i++){
            // add $i days to $fromTo->from clone (NOT reference val)
            $optionFrom = (clone $fromTo->from)->add(new \DateInterval("P". $i. "D"));
            
            // get $from and $to pair to return
            $from = $optionFrom->getTimestamp();
            $to = (new \DateTime( //take date from $optionFrom and use original time var from $fromTo->to
                    $optionFrom->format('Y-m-d'). 
                    " ". 
                    $fromTo->to->format('H:i:s')
                ))->getTimestamp();
                
            // parse to array as stdClass ('from'&'to')
            $res[$i] = (object)[
                'from' => $from,
                'to' => $to,
            ];
        }
        
        return $res;
    }
    
    // return $memberEvents: Array
    //      ex. [userId => 
    //              ['from': (timestamp), 'to': (timestamp)],
    //              ...
    //          ...]
    public static function getMemberEventsAll(Group $group, $exceptions = null){
        $memberEvents = []; //array to return
        
        // get members
        $members = $group->users;
        
        // parse timestamps of events in member-each to $memberEvents
        foreach($members as $m){
            $memberEvents[$m->id] = $m->getEventsAllAsTimestamps($exceptions);
        }
        
        return $memberEvents;
    }
    
    // return wanna-be: [0 => [
    //                      'from': (timestamp), 'to': (timestamp)
    //                      'availables': [(int) userId, ...]
    //                  ]]
    public static function getAvailabilitiesAll($options, $memberEvents){
        $availableDatesOfMembers = Event::getAvailableDatesOfGroupMembers($options, $memberEvents);
        \Debugbar::info('$availableDatesOfMembers');
        \Debugbar::info($availableDatesOfMembers);
        $availabilities = Event::initAvailabilitiesArray($options);
        $c = count($availabilities);
        for($i=0; $i<$c; $i++){
            foreach($availableDatesOfMembers as $id => $aDsOM){
                if(!Event::isFromToPairMatched($availabilities[$i], $aDsOM)) continue;
                
                array_push($availabilities[$i]->availables, $id);
            }
        }
        
        if(count($availabilities) == 0) return false; //exception handling
        
        return $availabilities;
    }
    
    public static function isFromToPairMatched($fromToPair, $subjectFromToPairs){
        \Debugbar::info('$subjectFromToPairs');
        \Debugbar::info($subjectFromToPairs);
        
        foreach($subjectFromToPairs as $subject){
            if(
                ($fromToPair->from == $subject->from) &&
                ($fromToPair->to == $subject->to)
            ) return true;
        }
        
        return false;
    }
    
    // return wanna-be: [0 => [
    //                      'from': (timestamp), 'to': (timestamp)
    //                      'availables': [empty array]
    //                  ]]
    public static function initAvailabilitiesArray($options){
        $availabilities = [];
        
        foreach($options as $key => $option){
            $availabilities[$key] = (object)[
                    'from' => $option->from,
                    'to' => $option->to,
                    'availables' => [],
                ];
        }
        
        if(count($availabilities) == 0) return false;
        
        return $availabilities;
    }
    
    // return wanna-be: [userId => [
    //                          'from': (timestamp), 'to': (timestamp),
    //                          ...
    //                      ]...
    //                  ]
    public static function getAvailableDatesOfGroupMembers($options, $memberEvents){
        $availableDates = [];
        foreach($memberEvents as $id => $events){
            $availableDates[$id] = Event::getAvailableDates($options, $events);
        }
        
        return $availableDates;
    }
    
    // @param $options: array of from-to pair (stdClass)
    // @param $events: array of from-to pair (stdClass)
    // return [0 => [
    //                  'from': (timestamp), 'to': (timestamp)
    //              ]...
    //          ]
    public static function getAvailableDates($options, $events){
        $availableDates = [];
        
        foreach($options as $option){
            $collided = false;
            foreach($events as $event){
                $collided = GeneralHelper::collideLines(
                    new Vec2($option->from, $option->to),
                    new Vec2($event->from, $event->to)
                );
                
                if($collided) break;
            }
            
            if(!$collided){
                array_push($availableDates, $option);
            }
        }
        
        \Debugbar::info('$availableDates');
        \Debugbar::info($availableDates);
        
        if(count($availableDates) == 0) return false;
        
        return $availableDates;
    }
    
    //------------------------------
    //@converting functions
    //------------------------------
    public static function eventDateTimeOption2Timestamps(Event $val){
        $dateTime = Event::eventDateTimeOption2DateTimes($val);
        
        return (object)[
            'from' => $dateTime->from->getTimestamp(),
            'to' => $dateTime->to->getTimestamp(),
        ];
    }
    
    protected static function eventDateTimeOption2DateTimes(Event $val){
        $from = new \DateTime($val->dateFrom. " ". $val->timeFrom);
        $to = new \DateTime($val->dateTo. " ". $val->timeTo);
        // $from = new \DateTime($val->dateTimeFromSelf);
        // $to = new \DateTime($val->dateTimeToSelf);
        
        return (object)[
            'from' => $from,
            'to' => $to,
        ];
    }
    
    public static function eventDateTimeSelf2Timestamps(Event $val){
        $dateTime = Event::eventDateTimeSelf2DateTimes($val);
        
        return (object)[
            'from' => $dateTime->from->getTimestamp(),
            'to' => $dateTime->to->getTimestamp(),
        ];
    }
    
    protected static function eventDateTimeSelf2DateTimes(Event $val){
        // $from = new \DateTime($val->dateFrom. " ". $val->timeFrom);
        // $to = new \DateTime($val->dateTo. " ". $val->timeTo);
        $from = new \DateTime($val->dateTimeFromSelf);
        $to = new \DateTime($val->dateTimeToSelf);
        
        return (object)[
            'from' => $from,
            'to' => $to,
        ];
    }
    
    public static function request2Event(Request $request){
        // exception handling
        $cond = isset($request->dateFrom) &&
                isset($request->dateTo) &&
                isset($request->timeFrom) &&
                isset($request->timeTo);
        if(!$cond) return false;
        
        $event = new Event();
        $event->dateFrom = $request->dateFrom;
        $event->dateTo = $request->dateTo;
        $event->timeFrom = $request->timeFrom;
        $event->timeTo = $request->timeTo;
        
        return $event;
    }
    
}
