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
       if(isset($_GET['layout'])){
           $layout = $_GET['layout'];
           $userId = \Auth::user()->id;
           $table = User::find($userId);
           
           if($layout == '1'){ // original
               $layout = 'css/.original.css';
           }
           if($layout == '2'){ // black
               $layout = 'css/black.css';
           }
           if($layout == '3'){ // pink
               $layout = 'css/pink.css';
           }
            if($layout == '4'){ // beige
               $layout = 'css/beige.css';
           }
           if($layout == '5'){ // aqua
               $layout = 'css/aqua.css';
           }
           if($layout == '6'){ // flower
               $layout = 'css/flower.css';
           }if($layout == '7'){ // fruits
               $layout = 'css//fruits.css';
           }if($layout == '8'){ // beach
               $layout = 'css/beach.css';
           }
           if($layout == '9'){ // galaxy
               $layout = 'css/galaxy.css';
           }
             if($layout == '10'){ // snow
               $layout = 'css/snow.css';
           }
            if($layout == '11'){ //newyork
               $layout = 'css/newyork.css';
           }
           if($layout == '12'){ //cafe
               $layout = 'css/cafe.css';
           }
           if($layout == '13'){ //beer
               $layout = 'css/beer.css';
           }
            if($layout == '14'){ //neon
               $layout = 'css/neon.css';
           }
           $table->layout = $layout;
           $table->save();
       }
       
        return redirect()->back();
    }
}
