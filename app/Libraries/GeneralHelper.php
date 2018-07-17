<?php 
namespace App\Libraries;

class GeneralHelper{
    public static function collection2Array($collection){
        $a = [];
        foreach($collection as $item){
            array_push($a, $item);
        }
        
        return $a;
    }
    
    public static function collideLines(Vec2 $line, Vec2 $line2){
        $cond = $line->x < $line2->y;
        $cond2 = $line->y > $line2->x;
        if($cond && $cond2){
            return true;
        }
        return false;
    }
}