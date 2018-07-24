<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SettingsController extends Controller
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
       
        return view('users.settings');
    }
    
    public function changeTheme()
    {
        if(!isset($_GET['layout'])) return redirect()->back()->with('messageDanger', 'Invalid theme code detected');
        
        $layout = $_GET['layout'];
        $userId = \Auth::user()->id;
        $table = User::find($userId);
           
        if($layout == '2'){ // original
            $layout = null;
        }
        if($layout == '3'){ // pink
            $layout = 'pink';
        }
        if($layout == '4'){ // beige
           $layout = 'beige';
        }
        if($layout == '5'){ // navy
            $layout = 'navy';
        }
        if($layout == '6'){ // flower
            $layout = 'flower';
        }
        if($layout == '7'){ // fruits
            $layout = 'fruits';
        }
        if($layout == '8'){ // beach
            $layout = 'beach';
        }
        if($layout == '9'){ // galaxy
            $layout = 'galaxy';
        }
        if($layout == '10'){ // snow
            $layout = 'snow';
        }
        if($layout == '11'){ //newyork
            $layout = 'newyork';
        }
        if($layout == '12'){ //cafe
            $layout = 'cafe';
        }
        if($layout == '13'){ //beer
            $layout = 'beer';
        }
        if($layout == '14'){ //neon
            $layout = 'neon';
        }
        
        $table->layout = $layout;
        $table->save();
       
        return redirect()->back();
    }
}