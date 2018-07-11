<?php

namespace App\Libraries;

use DateInterval;

class OctopathHelper{
    public static function create_octopath_url($octopath){
        return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://". explode(':', $_SERVER['HTTP_HOST'])[0]. '/'.  $octopath; //drop port number by explode()
    }
    
    public static function get_limited_value($value, $limit){
        if($value > $limit){
            $value = $limit;
        }
        
        return $value;
    }
    
    public static function get_today(){
        return explode('T', date('c'))[0];
    }
    
    public static function get_date_year_added($date, $value=1){
        $date = date_create($date);
        $date->add( DateInterval::createFromDateString(($value == 1) ? $value. 'year' : $value. ' years') );
        
        return date_format($date, 'Y-m-d');
    }
    
    /*
    | Generate the most likely unique key derived from randomized value, using microtime() as the seed
    | returns: octopath (string)
    */
    public static function generate_octopath(){
        srand(OctopathHelper::create_seed());
        return OctopathHelper::base_convert_x((string)rand());
    }
    
    public static function create_seed(){
        list($msec, $sec) = explode(" ", microtime());
        return (int)(($sec + $msec) * 1000000);
    }
    
    //reference from: http://php.net/manual/en/function.base-convert.php#109308, corrected a bit (init of $_10to62, $_62to10)
    public static function base_convert_x( $_number='', $_frBase=10, $_toBase=62 ) {

        //Today's Date - C74 - convert a string (+ve integer) from any arbitrary base to any arbitrary base, up to base 62, using  0-9,A-Z,a-z
        //Usage :   echo base_convert_x( 123456789012345, 10, 32 );

          $_10to62 =  array(
            '0'  => '0', '1'  => '1', '2'  => '2', '3'  => '3', '4'  => '4', '5'  => '5', '6'  => '6', '7'  => '7', '8'  => '8', '9'  => '9', '00' => '0', '01' => '1', '02' => '2', '03' => '3', '04' => '4', '05' => '5', '06' => '6', '07' => '7', '08' => '8', '09' => '9',
            '10' => 'A', '11' => 'B', '12' => 'C', '13' => 'D', '14' => 'E', '15' => 'F', '16' => 'G', '17' => 'H', '18' => 'I', '19' => 'J', '20' => 'K', '21' => 'L', '22' => 'M', '23' => 'N', '24' => 'O', '25' => 'P', '26' => 'Q', '27' => 'R', '28' => 'S', '29' => 'T',
            '30' => 'U', '31' => 'V', '32' => 'W', '33' => 'X', '34' => 'Y', '35' => 'Z', '36' => 'a', '37' => 'b', '38' => 'c', '39' => 'd', '40' => 'e', '41' => 'f', '42' => 'g', '43' => 'h', '44' => 'i', '45' => 'j', '46' => 'k', '47' => 'l', '48' => 'm', '49' => 'n',
            '50' => 'o', '51' => 'p', '52' => 'q', '53' => 'r', '54' => 's', '55' => 't', '56' => 'u', '57' => 'v', '58' => 'w', '59' => 'x', '60' => 'y', '61' => 'z'  );
        
          $_62to10 =  array(
            '0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06', '7' => '07', '8' => '08', '9' => '09', 'A' => '10', 'B' => '11', 'C' => '12', 'D' => '13', 'E' => '14', 'F' => '15', 'G' => '16', 'H' => '17', 'I' => '18', 'J' => '19',
            'K' => '20', 'L' => '21', 'M' => '22', 'N' => '23', 'O' => '24', 'P' => '25', 'Q' => '26', 'R' => '27', 'S' => '28', 'T' => '29', 'U' => '30', 'V' => '31', 'W' => '32', 'X' => '33', 'Y' => '34', 'Z' => '35', 'a' => '36', 'b' => '37', 'c' => '38', 'd' => '39',
            'e' => '40', 'f' => '41', 'g' => '42', 'h' => '43', 'i' => '44', 'j' => '45', 'k' => '46', 'l' => '47', 'm' => '48', 'n' => '49', 'o' => '50', 'p' => '51', 'q' => '52', 'r' => '53', 's' => '54', 't' => '55', 'u' => '56', 'v' => '57', 'w' => '58', 'x' => '59',
            'y' => '60', 'z' => '61' );

        //First convert from frBase to base-10

        $_in_b10        =   0;
        $_pwr_of_frB    =   1;                        //power of from base, eg. 1, 8, 64, 512
        $_chars         =   str_split( $_number );    //split input number into chars
        $_str_len       =   strlen( $_number );
        $_pos           =   0;

        while     (  $_pos++ < $_str_len )  {
            $_char          =   $_chars[$_str_len - $_pos];
            $_in_b10       +=   (((int) $_62to10[$_char] ) * $_pwr_of_frB);
            $_pwr_of_frB   *=   $_frBase;
        }

        //Now convert from base-10 to toBase

        $_dividend      =   (int)$_in_b10;         //name dividend easier to follow below
        $_in_toB        =   '';                       //number string in toBase
    
        while     ( $_dividend > 0 )        {
    
            $_quotient  =   (int) ( $_dividend / $_toBase );    //eg. 789 / 62  =  12  ( C in base 62 )
            $_remainder =   ''  .  ( $_dividend % $_toBase );   //789 % 62  =  45  ( j in base 62 )
            $_in_toB    =   $_10to62[$_remainder] . $_in_toB;   //789  (in base 10)  =    Cj  (in base 62)
            $_dividend  =   $_quotient;                         //new dividend is the quotient from base division
        }
    
        if  ( $_in_toB  ==  '' )
              $_in_toB  =   '0';
    
        return    $_in_toB;                           //base $_toBase string
    }
}