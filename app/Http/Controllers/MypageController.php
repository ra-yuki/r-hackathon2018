<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\CalendarHelper;

use App\Event;

class MypageController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //*-- get days of the $year/$month with offset --*//
        $days = []; //0 means empty
        $year = (isset($_GET['year'])) ? $_GET['year'] : (new \DateTime())->format('Y');
        $month = (isset($_GET['month'])) ? $_GET['month'] : (new \DateTime())->format('m');
        $firstDay = date( 'D', (new \DateTime("$year-$month-01"))->getTimestamp() );
        $firstDayNum = CalendarHelper::Day2Num($firstDay);
        // set offset to adjust the day number and string 
        // (e.g. when day 1 is Tuesday, we should offset to pivot the day to where Tuesday is located)
        for($i=0; $i<$firstDayNum; $i++){
            array_push($days, 0); //0 means empty
        }
        // set days until the end of the month
        $datetime = new \DateTime("$year-$month-01");
        while((int)$datetime->format('m') == $month){
            array_push($days, (int)$datetime->format('d'));
            $datetime->add(new \DateInterval("P1D"));
        }
        
        //*-- get relevant events --*//
        $yearMonthPair = (new \DateTime("$year-$month-01"))->format('Y-m');
        $events = \Auth::user()->getEventsAllAsCollection()->reject(function($value, $key) use ($yearMonthPair) {
                return mb_strpos($value->dateTimeFromSelf, $yearMonthPair);
            })->sortBy('dateTimeFromSelf');

        //*-- get unfixed events --*//
        $eventsUnfixed = \Auth::user()->getEventsAllAsCollection()->reject(function($value, $key){
                return ($value->fixed == true);
            })->sortBy('dateTimeFromSelf');

        $eventsUnfixedCleaned = []; //make events' eventPath unique
        foreach($eventsUnfixed as $e){
            $count = 0;
            foreach($eventsUnfixedCleaned as $eCleaned){
                if($e->eventPath != $eCleaned->eventPath) continue;
                $count++;
            }
            if($count == 0){
                array_push($eventsUnfixedCleaned, $e);
            }
        }
        
        // get holidays
        $holidays = \Yasumi\Yasumi::create('Japan', $year, 'ja_JP');
        $holidaysOfMonth = [];
        foreach ($holidays as $holiday){
            if($month == explode('-', $holiday)[1]){
                $holidaysOfMonth[explode('-', $holiday)[2]] = $holiday->getName();
            }
        }
        
        // data to parse
        $date = new \DateTime("$year-$month-01");
        $dateNext = (clone $date)->add(new \DateInterval("P1M"));
        $datePrev = (clone $date)->sub(new \DateInterval("P1M"));
        $data = [
            'year' => $year,
            'month' => $month,
            'days' => $days,
            'yearNext' => $dateNext->format('Y'),
            'yearPrev' => $datePrev->format('Y'),
            'monthNext' => $dateNext->format('m'),
            'monthPrev' => $datePrev->format('m'),
            
            'events' => $events,
            'eventsUnfixed' => $eventsUnfixedCleaned,
            
            'holidays' => $holidaysOfMonth,
        ];
        
        // render
        return view('users.index', $data);
    }

}
