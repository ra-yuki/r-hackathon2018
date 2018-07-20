<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Group;
use App\Poll;
use App\Libraries\Vec2;
use App\Libraries\OctopathHelper;
use App\Libraries\Config;

///////////////////////////////////////////////////////////
//*-- go for it strategy from midnight me;) --*//
///////////////////////////////////////////////////////////
// 1. get user-determined range of events with UNIX timestamp conversion on it and store them in an array (a1).
// 2. create an array (a2) that represents all the possible options of the scheduling event (UNIX timestamped).
// 3. run collision detection with each elements of a1 and a2.
// pseudo-code
// foreach(a2){
//   var collided = false;
//   foreach(a1){
//       if a2.item.Collide(a1.item)
//          collided = true;
//          break;
//       endif
//   }
//   if !collided
//      print "a2.item is schedulable!";
//   endif
// }

class EventsController extends Controller
{
    function index(){
        $events = Event::all();
        return view('events.index', [
            'events' => $events,
        ]);
    }
    
    function show($id){
        // exception handling
        if(!Event::find($id)->fixed) abort(404);
        
        $event = Event::find($id);
        $eventOtherOptions = Event::where([
            ['eventPath', '=', $event->eventPath],
            ['id', '<>', $event->id],
        ])->get();
        return view('events.show', [
            'event' => $event,
            'eventOtherOptions' => $eventOtherOptions,
        ]);
    }
    
    function fix($id){
        // fix the event of the date
        $event = Event::find($id);
        $event->fixed = true;
        $event->save();
        
        // delete other options of the $event
        Event::where([
            ['eventPath', '=', $event->eventPath],
            ['id', '<>', $event->id],
        ])->delete();
        
        return redirect()->route('events.show', ['id' => $id])->with('message', 'Fixed \''. $event->title .'\' on '. explode(' ', $event->dateTimeFromSelf)[0]. '!');
    }
    
    public function edit($id)
    {
        $event = Event::find($id);
        
        return view ('events.edit', [
            'event' => $event,
        ]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $event->dateTimeFromSelf = $request->dateFrom. " ". $request->timeFrom;
        $event->dateTimeToSelf = $request->dateTo. " ". $request->timeTo;
        $event->title = $request->title;
        $event->save();
        
        return redirect()->route('events.show', ['id' => $event->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $title = $event->title;
        
        // delete all the $event with the same event path
        Event::where([
            ['eventPath', '=', $event->eventPath],
        ])->delete();
        
        return redirect()->route('mypage.index')->with('messageDanger', 'Deleted \''. $title .'\' successfully.');
    }
    
    public function showHub($eventPath){
        $events = Event::where('eventPath', $eventPath)->orderBy('dateTimeFromSelf')->get();
        
        $plan = $events[0];
        $group = $plan->groups[0];
        $users = $group->users;
        $schedulables = Event::getSchedulablesWithGroup($plan, $group, $events);
        
        $retrieved = Event::retrieveFromSchedulables($schedulables, clone $events);
        $fetched = Event::fetchAvailables($retrieved, clone $events);
        
        \Debugbar::info('$schedulables');
        \Debugbar::info($schedulables);
        \Debugbar::info('$retrieved');
        \Debugbar::info($retrieved);
        \Debugbar::info('$fetched');
        \Debugbar::info($fetched);
        \Debugbar::info('$events');
        \Debugbar::info($events);
        
        // get poll data
        $polls = Poll::findFromEventPath($events[0]->eventPath);
        
        return view('events.hub', [
            'events' => $fetched,
            'users' => $users,
            'polls' => $polls,
        ]);
    }
    
    function showScheduleWithGroup(){
        // get groups
        $groups = \Auth::user()->groups()->where('visibility', '1')->get();
        
        return view('events.create', [
            'groups' => $groups,    
        ]);
    }
    
    public function showRescheduleWithGroup($id){
        $event = Event::find($id);
        $groupSelected = Group::find($event->groups()->first()->id);
        $groups = \Auth::user()->groups()->where('visibility', '1')->get();
        
        return view('events.create', [
            'event' => $event,
            'groupSelected' => $groupSelected,
            'groups' => $groups,
        ]);
    }
    
    function showScheduleInPrivate(){
        return view('events.create-private');
    }
    
    function scheduleInPrivate(Request $request){
        // add to events table
        $event = new Event();
        $event->dateTimeFromSelf = $request->dateFrom. " ". $request->timeFrom;
        $event->dateTimeToSelf = $request->dateTo. " ". $request->timeTo;
        $event->title = $request->title;
        $event->fixed = true;
        $event->eventPath = OctopathHelper::generate_octopath();
        $event->save();
        
        // sub to the $event
        //create private group if not exists
        if(\Auth::user()->groups()->where('name', Config::getPrivateGroupName())->first() == null){
            $g = new Group();
            $g->name = Config::getPrivateGroupName();
            $g->visibility = false;
            $g->save();
            \Auth::user()->groups()->attach($g->id);
        }
        \Auth::user()->groups()->where('name', Config::getPrivateGroupName())->first()->subscribeEvent($event->id);
        
        return redirect()->route('events.show', ['id' => $event->id])->with('message', 'Private event ('.$event->title.') has been created successfully!');
    }
    
    function scheduleWithGroup(Request $request){
        // convert request to event obj
        $plan = Event::request2Event($request);
        // exception handling
        if(!$plan) return false;
        
        \Debugbar::info('$plan');
        \Debugbar::info($plan);
        
        // get group obj
        $group = Group::find($request->groupId);
        
        \Debugbar::info('$group');
        \Debugbar::info($group);
        
        // schedule and get the result
        $schedulables = Event::getBestSchedulablesWithGroup($plan, $group);
        // exception handling
        if(!$schedulables) return false;
        
        \Debugbar::info('$schedulables');
        \Debugbar::info($schedulables);
        
        //save to db
        $res = Event::saveSchedulablesWithGroup($plan, $group, $request, $schedulables);
        if(!$res) return false;
        
        \Debugbar::info('$res');
        \Debugbar::info($res);
        
        return redirect()->route('events.showHub', ['eventPath' => $res])->with('message', 'Calculated the best dates for \''. $plan->title .'\'!');
    }
    
    function rescheduleWithGroup(Request $request, $id){
        $event = Event::find($id);
        \Debugbar::info('$event');
        \Debugbar::info($event);
        Event::where([
            ['eventPath', '=', $event->eventPath],
        ])->delete();
        
        return $this->scheduleWithGroup($request);
    }
    
    //*-- #DEBUG --*//
    function generateEventFromArg($dateTimeFrom, $dateTimeTo, $title){
        $table = new Event();
        
        $table->dateTimeFromSelf = $dateTimeFrom;
        $table->dateTimeToSelf = $dateTimeTo;
        $table->title = $title;
        $table->fixed = true;
        $table->eventPath = OctopathHelper::generate_octopath();

        $table->save();
    }
}

// old alrogithms
    // // can't handle event that goes across with this algorithm
    // function scheduleEvents(Request $request){
    //     //event you wanna insert from input form
    //     $schedulingEvent = new Event();
    //     $schedulingEvent->dateFrom = $request->dateFrom;
    //     $schedulingEvent->dateTo = $request->dateTo;
    //     $schedulingEvent->timeFrom = $request->timeFrom;
    //     $schedulingEvent->timeTo = $request->timeTo;
        
    //     // split each day&time options to an array
    //     $schedulingEvents = [];
    //     $formattedFrom = new \DateTime($eventScheduling->dateFrom);
    //     $formattedTo = new \DateTime($eventScheduling->dateTo);
    //     $daysDiff = $formattedFrom->diff($formattedTo);
    //     for($i=0; $i<$daysDiff+1; $i++){
    //         $schedulingEvent_ = clone $schedulingEvent;
    //         $tmp = new \DateTime($schedulingEvent_->dateFrom);
    //         $tmp->add(new \DateInterval("P".$i."D")); //add 1 day
    //         $schedulingEvent_->dateFrom = $tmp->format('Y-m-d');
    //         $event = new Event();
    //         $event->dateFrom = $schedulingEvent_->dateFrom;
    //         $event->dateTo = $schedulingEvent_->dateFrom;
    //         $event->timeFrom = $schedulingEvent_->timeFrom;
    //         $event->timeTo = $schedulingEvent_->timeTo;
    //         array_push($schedulingEvents, $event);
    //     }
        
    //     // get events
    //     $userEvents = Event::all();
        
    //     // var_dump($this->getAvailableDates($schedulingEvent));
    //     var_dump($this->getAvailableDates2($userEvents, $schedulingEvents));
    // }


    //*-- get all the available dates (=insertable dates) from dateFrom to dateTo --*//
    // function getAvailableDates($eventScheduling){
    //     $dateFrom2Search = new \DateTime($eventScheduling->dateFrom);
    //     $dateTo2Search = new \DateTime($eventScheduling->dateTo);
    //     $dateDiff2Search = $dateFrom2Search->diff($dateTo2Search)->days;

    //     $availableDates = [];
    //     for($i=0; $i<$dateDiff2Search+1; $i++){
    //         $dateFrom2Search_ = clone $dateFrom2Search; //clone dateFrom2Search to avoid reference parse
    //         $dateFrom2Search_->add(new \DateInterval("P".$i."D")); //move to next day
    //         $dateFrom2SearchFormatted = $dateFrom2Search_->format('Y-m-d'); //format to manipulating-friendly
    //         // echo "i:$i df2s:$dateFrom2SearchFormatted, ";
    //         $events = Event::where('dateFrom', '=', $dateFrom2SearchFormatted)->get(); //get events starting on the same date
            
    //         //determine if $event is insertable(=$available) somewhere bet $events and save to array(=$availableDates)
    //         $available = true;
    //         foreach($events as $event){
    //             $interected = $this->isIntersected($event, $eventScheduling);
    //             if($interected){
    //                 $available = false;
    //                 break;
    //             }
    //         }
    //         if($available){
    //             array_push($availableDates, $dateFrom2SearchFormatted);
    //         }
    //     }
        
    //     return $availableDates;
    // }

    // function isIntersected($event, $event2){
    //     //convert time column data to DateTime object
    //     $eventTime = ["from" => new \DateTime($event->timeFrom), "to" => new \DateTime($event->timeTo)];
    //     $event2Time = ["from" => new \DateTime($event2->timeFrom), "to" => new \DateTime($event2->timeTo)];
        
    //     //get each time length
    //     $interval = $event2Time['from']->getTimestamp() - $eventTime['from']->getTimestamp();
        
    //     $bothActualTimeLength = ($interval<0) ? 
    //         $eventTime['to']->getTimestamp() - $event2Time['from']->getTimestamp() :
    //         $event2Time['to']->getTimestamp() - $eventTime['from']->getTimestamp();
    //     $eventTimeLength = $eventTime['to']->getTimestamp() - $eventTime['from']->getTimestamp();
    //     $event2TimeLength = $event2Time['to']->getTimestamp() - $event2Time['from']->getTimestamp();
    //     $bothShortestTimeLength = $eventTimeLength + $event2TimeLength;
        
    //     // echo "both:  $bothTimeLength, ";
    //     // echo "event: $eventTimeLength, ";
    //     // echo "event2:$event2TimeLength, ";
        
    //     //if length of event to event2 is smaller than length of event and event2, intersected!
    //     return $bothActualTimeLength - $bothShortestTimeLength < 0;
    // }
    
    // can't handle event that goes across with this algorithm
    // function scheduleGroupEvent(Request $request){
    //     //*-- 1. event you wanna schedule --*//
    //     $schedulingEvent = new Event();
    //     $schedulingEvent->dateFrom = $request->dateFrom;
    //     $schedulingEvent->dateTo = $request->dateTo;
    //     $schedulingEvent->timeFrom = $request->timeFrom;
    //     $schedulingEvent->timeTo = $request->timeTo;
    //     $schedulingEvent->title = $request->title;
    //     $schedulingEvent->fixed = false;
    //     $schedulingEvent->eventPath = OctopathHelper::generate_octopath();
    //     $groupId = $request->groupId;
        
    //     \Debugbar::info('1. get request data');
    //     \Debugbar::info($schedulingEvent);
        
    //     // 2. split each day&time options to an array
    //     $schedulingEvents = [];
    //     // get count of options
    //     $formattedFrom = new \DateTime($schedulingEvent->dateFrom);
    //     $formattedTo = new \DateTime($schedulingEvent->dateTo);
    //     $daysDiff = $formattedFrom->diff($formattedTo)->days;
    //     for($i=0; $i<$daysDiff+1; $i++){
    //         $schedulingEvent_ = clone $schedulingEvent;
    //         $tmp = new \DateTime($schedulingEvent_->dateFrom);
    //         $tmp->add(new \DateInterval("P".$i."D")); //add $i days
    //         $schedulingEvent_->dateFrom = $tmp->format('Y-m-d');
            
    //         $event = new Event();
    //         $event->dateFrom = $schedulingEvent_->dateFrom;
    //         $event->dateTo = $schedulingEvent_->dateFrom;
    //         $event->timeFrom = $schedulingEvent_->timeFrom;
    //         $event->timeTo = $schedulingEvent_->timeTo;
    //         array_push($schedulingEvents, $event);
    //     }
        
    //     \Debugbar::info('2. create (time)from - to pair for each (date)from - to');
    //     \Debugbar::info($schedulingEvents);
        
    //     //*-- 3. get all the events of each users --*//
    //     // $userEvents = $this->getFakeUsersEvents(5); // this runs fine (for development)
    //     $userEvents = [];
    //     $users = Group::find($groupId)->users;
    //     foreach($users as $user){
    //         // get all the events that the user has
    //         $groups = $user->groups;
    //         $tmp = [];
    //         foreach($groups as $group){
    //             $tmp = array_merge($tmp, $this->collection2Array($group->events));
    //         }
    //         // push the events to an array
    //         array_push($userEvents, $tmp);
    //     }
        
    //     \Debugbar::info('3. get each user events of the group');
    //     \Debugbar::info($userEvents);

    //     //*-- 4. get available dates for each users *--//
    //     $availableDatesPerUser = [];
    //     foreach($userEvents as $key => $userEvent){
    //         $res = $this->getAvailableDates($userEvent, $schedulingEvents);
    //         $availableDatesPerUser[$key] = $res;
    //     }
        
    //     \Debugbar::info('4. get available dates for each users');
    //     \Debugbar::info($availableDatesPerUser);
        
    //     //*-- 5. get the common available dates --*//
    //     $res = $this->getCommonAvailableDates($availableDatesPerUser, $schedulingEvents);
        
    //     \Debugbar::info('5. get the common available dates among users');
    //     \Debugbar::info($res);
        
    //     //*-- 6. get the most emptied date(s) --*//
    //     $userNum = count($users);
    //     $threshold = round($userNum * 0.5);
    //     $maxJoinable = max($res);
    //     $schedulableDateTimes = [];
    //     if($maxJoinable >= $threshold){ //if more than minimum required ppl ($threshold), can make it happen!
    //         foreach($res as $key => $val){ //get $maxJoinable dates and parse to an array ($schedulableDateTimes)
    //             if($val == $maxJoinable)
    //                 $schedulableDateTimes[$key] = $val;
    //         }
    //     }
    //     else {// too few ppl -> no schedulable dates
    //         $schedulableDateTimes = null;
    //     }
        
    //     \Debugbar::info('6. get the most emptied date(s)');
    //     \Debugbar::info($schedulableDateTimes);
        
    //     //*-- 7. add available dates to events table --*//
    //     foreach($schedulableDateTimes as $key => $val){
    //         $schedulingEvent_ = clone $schedulingEvent;
    //         $schedulingEvent_->dateTimeFromSelf = explode(',', $key)[0];
    //         $schedulingEvent_->dateTimeToSelf = explode(',', $key)[1];
    //         $saved = $schedulingEvent_->save();
    //         // sub to the $event
    //         $group = Group::find($groupId);
    //         $group->subscribeEvent($schedulingEvent_->id);
    //     }
        
    //     \Debugbar::info('7. save (6.) to DB');
    //     \Debugbar::info($saved);
        
    //     //*-- 8. parse to view --*//
    //     // return view('events.result-create', [
    //     //     'result' => $schedulableDateTimes,
    //     //     'max' => $maxJoinable,
    //     //     'threshold' => $threshold,
    //     // ]);
    //     // return redirect()->route('mypage.index');
    //     \Debugbar::info('8. view');
    //     return view ('tmp.after-group-event-creation');
    // }
    
    // function collection2Array($collection){
    //     $a = [];
    //     foreach($collection as $item){
    //         array_push($a, $item);
    //     }
        
    //     return $a;
    // }
    
    // //compare available dates of each users
    // function getCommonAvailableDates($availableDatesPerUser, $schedulingEvents){
    //     $res = [];
    //     //iterate events we wanna schedule
    //     foreach($schedulingEvents as $se){
    //         $seFrom = new \DateTime($se->dateFrom . " " . $se->timeFrom);
    //         $seTo = new \DateTime($se->dateTo . " " . $se->timeTo);
    //         //iterate each user
    //         foreach($availableDatesPerUser as $ae){
    //             //iterate available dates the user has
    //             foreach($ae as $fromTo){
    //                 if($seFrom->getTimestamp() == $fromTo['from']){
    //                     $key = $seFrom->format('Y-m-d H:i:s'). ",". $seTo->format('Y-m-d H:i:s');
    //                     $res[$key] = (isset($res[$key])) ? $res[$key]+1 : 1;
    //                 }
    //             }
    //         }
    //     }
        
    //     return $res;
    // }
    
    // function getAvailableDates($userEvents, $schedulingEvents){
    //     // array for available dates
    //     $availableDates = [];
        
    //     foreach($schedulingEvents as $sEvent){
    //         $collided = 0;
    //         // get timestamped sEvent
    //         $sEventFromTimestamp = (new \DateTime($sEvent->dateFrom . " " . $sEvent->timeFrom))->getTimestamp();
    //         $sEventToTimestamp = (new \DateTime($sEvent->dateTo . " " . $sEvent->timeTo))->getTimestamp();

    //         foreach($userEvents as $uEvent){
    //             // get timestamped uEvent
    //             $uEventFromTimestamp = (new \DateTime($uEvent->dateTimeFromSelf))->getTimestamp();
    //             $uEventToTimestamp = (new \DateTime($uEvent->dateTimeToSelf))->getTimestamp();
    //             // detect collisions
    //             $res = $this->collideLines(new Vec2($sEventFromTimestamp, $sEventToTimestamp), new Vec2($uEventFromTimestamp, $uEventToTimestamp));
    //             if($res){ $collided++;}
    //         }

    //         // if not collided, schedulable!
    //         if($collided == 0){
    //             $from = (new \DateTime($sEvent->dateFrom . " " . $sEvent->timeFrom))->getTimestamp();
    //             $to = (new \DateTime($sEvent->dateTo . " " . $sEvent->timeTo))->getTimestamp();
    //             array_push($availableDates, ['from'=>$from, 'to'=>$to]);
    //         }
            
    //     }
        
    //     return $availableDates; //return as timestamped form
    // }
    
    // function getAvailableDates_($userEvents, $schedulingEvents){
    //     // array for available dates
    //     $availableDates = [];
        
    //     foreach($schedulingEvents as $sEvent){
    //         // echo "inside start of foreach(schedulingEvents as sEvent)<br>";
    //         $collided = 0;
    //         // get timestamped sEvent
    //         // $sEventFromTimestamp = (new \DateTime($sEvent->dateFrom . " " . $sEvent->timeFrom))->getTimestamp();
    //         // $sEventToTimestamp = (new \DateTime($sEvent->dateTo . " " . $sEvent->timeTo))->getTimestamp();
    //         //@messing on friday
    //         $sEventFrom = new \DateTime($sEvent->dateFrom);
    //         $sEventTo = new \DateTime($sEvent->dateTo);
    //         $dateDiff2Search = $sEventFrom->diff($sEventTo)->days;
    //         for($i=0; $i<$dateDiff2Search; $i++){
    //             $sEventFrom_ = clone $sEventFrom;
    //             $sEventFrom_->add(new \DateInterval("P".$i."D"));
    //             $sEventFromTimestamp = (new \DateTime($sEventFrom_->format('Y-m-d') . " " . $sEvent->timeFrom))->getTimestamp();
    //             $sEventToTimestamp =  (new \DateTime($sEventFrom_->format('Y-m-d') . " " . $sEvent->timeTo))->getTimestamp();
            
    //         foreach($userEvents as $uEvent){
    //             // get timestamped uEvent
    //             $uEventFromTimestamp = (new \DateTime($uEvent->dateTimeFromSelf))->getTimestamp();
    //             $uEventToTimestamp = (new \DateTime($uEvent->dateTimeToSelf))->getTimestamp();
    //             // detect collisions
    //             // echo "sEvent: $sEvent->title | $sEventFromTimestamp(".date('y-m-d H:i:s', $sEventFromTimestamp).") - $sEventToTimestamp(".date('y-m-d H:i:s', $sEventToTimestamp).")<br>";
    //             // echo "uEvent: $uEvent->title | $uEventFromTimestamp(".date('y-m-d H:i:s', $uEventFromTimestamp).") - $uEventToTimestamp(".date('y-m-d H:i:s', $uEventToTimestamp).")<br>";
    //             $res = $this->collideLines(new Vec2($sEventFromTimestamp, $sEventToTimestamp), new Vec2($uEventFromTimestamp, $uEventToTimestamp));
    //             // var_dump($res);
    //             // echo "<br>---<br>";
    //             if($res){ $collided++; echo "<br>collided: true<br>";}
    //             // echo "<h1>end of foreach</h1>";
    //         }
    //         // echo "<h1>|end of for|</h1>";
    //         }

    //         // if not collided, schedulable!
    //         if($collided == 0){
    //             $from = (new \DateTime($sEvent->dateFrom . " " . $sEvent->timeFrom))->getTimestamp();
    //             $to = (new \DateTime($sEvent->dateTo . " " . $sEvent->timeTo))->getTimestamp();
    //             array_push($availableDates, ['from'=>$from, 'to'=>$to]);
                
    //             // echo "collided: false";
    //         }
            
    //         // echo("userEvents count: ". count($userEvents)."<br>");
    //     }
        
    //     // echo "<h1>|end of get available dates|</h1>";
    //     return $availableDates; //return as timestamped form
    // }
    
    // function collideLines(Vec2 $line, Vec2 $line2){
    //     $cond = $line->x < $line2->y;
    //     $cond2 = $line->y > $line2->x;
    //     if($cond && $cond2){
    //         return true;
    //     }
    //     return false;
    // }
    
    // public function showHub_($eventPath){
    //     $events = Event::where('eventPath', $eventPath)->orderBy('dateTimeFromSelf')->get();
    //     $groupJoined = $events[0]->groups[0];
    //     $users = $groupJoined->users;
        
    //     //*-- timestamped events dateTimeFromSelf and To --*//
    //     $eventsFromToTimestamp = [];
    //     foreach($events as $e){
    //         $eventsFromToTimestamp[$e->dateTimeFromSelf] = (new \DateTime($e->dateTimeFromSelf))->getTimestamp();
    //         $eventsFromToTimestamp[$e->dateTimeToSelf] = (new \DateTime($e->dateTimeToSelf))->getTimestamp();
    //     }
        
    //     //*-- get user events EXCL. events with $eventPath --*//
    //     $userEvents = [];
    //     foreach($users as $user){
    //         // get all the events that the user has
    //         $groups = $user->groups;
    //         $tmp = [];
    //         foreach($groups as $group){
    //             $eventsExclSelf = $group->events()->where('eventPath', '<>', $eventPath)->get();
    //             $tmp = array_merge($tmp, $this->collection2Array($eventsExclSelf));
    //         }
    //         // push the events to an array
    //         $userEvents[$user->id] = $tmp;
    //     }
        
    //     //*-- get available dates for each users *--//
    //     $availableDatesPerUser = [];
    //     foreach($userEvents as $key => $userEvent){
    //         // echo("userEvent count: ". count($userEvent)."<br>");
    //         $res = $this->getAvailableDates_($userEvent, $events);
    //         $availableDatesPerUser[$key] = $res;
    //     }
        
    //     // get availability of users of rach event days
    //     $usersAvailability = [];
    //     foreach($events as $e){
    //         foreach($users as $u){
    //             $isOk = true;
    //             foreach($availableDatesPerUser[$u->id] as $availableFromTo){
    //                 $isOk = ($availableFromTo['from'] == $eventsFromToTimestamp[$e->dateTimeFromSelf]) ? true : false;
    //                 if(!$isOk) break;
    //             }
                
    //             if($isOk) $usersAvailability[$e->id][$u->id] = true;
    //             else $usersAvailability[$e->id][$u->id] = false;
    //         }
    //     }
        
    //     //parse data to renderer
    //     return view('events.hub', [
    //         'events' => $events,
    //         'group' => $groupJoined,
    //         'users' => $users,
    //         'availableDates' => $availableDatesPerUser,
    //         'eventsFromToTimestamp' => $eventsFromToTimestamp,
    //         'usersAvailability' => $usersAvailability,
    //     ]);
    // }