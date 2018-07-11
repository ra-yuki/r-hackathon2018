<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
class GroupsController extends Controller
{
   
   function index(){
        $users =Group::All;
        
        return view('group.group', [
            'groups' => $groups,
        ]);
      
    }
    
    function show($id){
        // $group = Group::find($id);
        
        // return view('group.group_detail', [
        //     'group' => $group,
        // ]);
        
        $group= Group::find($id);
        $members = $group->users()->get();
        
        return view('group.group_detail', [
            'group' => $group,
            'members' => $members,
        ]);
    }
   
   public function store(Request $request, $id)
    {
        \Auth::user()->group($id);
        return redirect()->back();
    }

  
    
    public function delete()
    {
        $group = \App\Group::find($id);

        if (\Auth::user()->id === $group->user_id) {
            $group->delete();
        }

        return redirect()->back();
        
    }
}
