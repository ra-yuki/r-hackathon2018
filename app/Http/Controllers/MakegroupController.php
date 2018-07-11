<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MakegroupController extends Controller
{
        public function index()
    { 
        $friends=\Auth::user()->friends;
        return view('group.makegroup', [
            'friends' => $friends
        ]);
        
    }
   
    
        public function store(Request $request)
    {
        // get user input
        $friends = $request->friends;
        $groupName = $request->name;
        
        // add new group to groups table
        $group = new \App\Group();
        $group->name = $groupName;
        $group->visibility = true;
        $group->save();
        
        // subscribe users to the group
        \Auth::user()->groups()->attach($group->id);
        if(isset($request->friends)){
            foreach($friends as $friend){
                $friendObj = \App\User::find($friend);
                $friendObj->groups()->attach($group->id);
            }
        }
        
       return redirect()->route('friends.index');
        
        // $request->friends;
  
        // $friendid=$request->friends;
        
        
        
        // return view('group.groupname', [
        //     'friends' => $friends
            
        // ]);
    }
    
        public function destroy($id)
    {
        $group = \App\Makegroup::find($id);

        if (\Auth::user()->id === $group->user_id) {
            $group->delete();
        }

        return redirect()->back();
    }
}

