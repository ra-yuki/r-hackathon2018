<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\CalendarHelper;

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
        $year = (isset($_GET['year'])) ? $_GET['year'] : 2017;
        $month = (isset($_GET['month'])) ? $_GET['month'] : 2;
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
        
        return view('users.index', [
            'year' => $year,
            'month' => $month,
            'days' => $days,
        ]);
    }

}
