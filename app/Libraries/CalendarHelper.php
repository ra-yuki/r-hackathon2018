<?php 
namespace App\Libraries;

class CalendarHelper{
    public static function Day2Num($day){
        if($day == 'Mon') return 0;
        
        else if($day == 'Tue') return 1;
        else if($day == 'Wed') return 2;
        else if($day == 'Thu') return 3;
        
        else if($day == 'Fri') return 4;
        else if($day == 'Sat') return 5;
        else if($day == 'Sun') return 6;
    }
}