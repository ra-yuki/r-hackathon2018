<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AddFriendController extends Controller
{
    public function store(Request $request, $id)
    {
        \Auth::user()->friend($id);
        
        $friend = User::find($id);
        
        return redirect()->back()->with('message', $friend->name. ' is on your friend list now.');
 
    }
    
    public function destroy($id)
    {
        \Auth::user()->unfriend($id);
        
        $exfriend = User::find($id);
        
        return redirect()->back()->with('messageDanger', $exfriend->name. ' is out of your friend list now.');
    }
    
    public function destroyGet($id){
        \Auth::user()->unfriend($id);
        
        $exfriend = User::find($id);
        
        return redirect()->back()->with('messageDanger', $exfriend->name. ' is out of your friend list now.');
    }

   
}
