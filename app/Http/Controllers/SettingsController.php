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
       if(isset($_GET['layout'])){
           $layout = $_GET['layout'];
           $userId = \Auth::user()->id;
           $table = User::find($userId);
           
           if($layout == '1'){ // blue
               $layout = 'css/cool.css';
           }
           if($layout == '2'){ // cute
               $layout = 'css/cute.css';
           }
           if($layout == '3'){ // happy
               $layout = 'css/happy.css';
           }
           
           $table->layout = $layout;
           $table->save();
       }
       
        return view('users.settings');
    }
    
    public function settings(){
        echo "Hey";
        // return redirect()->back();
    }
}
