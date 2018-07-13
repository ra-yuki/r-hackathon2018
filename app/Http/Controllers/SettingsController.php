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
           
           if($layout == '1'){ // ocean
               $layout = 'css/ocean.css';
           }
           if($layout == '2'){ // cute
               $layout = 'css/cute.css';
           }
           if($layout == '3'){ // happy
               $layout = 'css/happy.css';
           }
            if($layout == '4'){ // natural
               $layout = 'css/natural.css';
           }
           if($layout == '5'){ // erika
               $layout = 'css/erika.css';
           }
           if($layout == '6'){ // mihana
               $layout = 'css/mihan.css';
           }if($layout == '7'){ // miyu
               $layout = 'css//miyu.css';
           }if($layout == '8'){ // so
               $layout = 'css/so.css';
           }
           
           $table->layout = $layout;
           $table->save();
       }
       
        return redirect()->back();
    }
}
