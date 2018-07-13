<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class ProfileController extends Controller
{
    function show($id){
        // $friendId=$request->id;
        // $userinst= new \App\User;
        // $user = $userinst::find($friendId);
        $user = User::find($id);
        
        return view('users.profile', [
            'user' => $user,
        ]);
    }
}
