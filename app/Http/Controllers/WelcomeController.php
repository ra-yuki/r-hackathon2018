<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
  
    function index(){
        if (\Auth::check())
            return redirect()->route('mypage.index');
            
        return view('welcome');
    }
}
