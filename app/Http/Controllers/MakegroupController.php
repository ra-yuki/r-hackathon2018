<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Config;

use App\Group;
use App\User;

class MakegroupController extends Controller
{
        public function index()
    { 
        $friends = \Auth::user()->friends()->orderBy('name')->get();
        
        return view('group.makegroup', [
            'friends' => $friends,
        ]);
        
    }
   
    
    public function store(Request $request) {
        //*-- validation handling --*//
        $validator = \Validator::make($request->all(), [
            'name' => ['required', 'max:191', 'regex:/^[^0123456789][^!@#$%\^&*\(\)`~]*$/'],
        ]);
        
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        //*-- main --*//
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
        
       return redirect()->route('friends.index')->with('message', 'Group \''. $group->name. '\' has been created successfully!');
    }
    
    public function update(Request $request, $id){
        //*-- validation handling --*//
        $validator = \Validator::make($request->all(), [
            'name' => ['required', 'max:191', 'regex:/^[^0123456789][^!@#$%\^&*\(\)`~]*$/'],
        ]);
        
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        //*-- main --*//
        // get user inputs
        $friendIds = $request->friends;
        $memberIds = $request->members;
        $groupName = $request->name;
        $group = Group::find($id);
        
        // update group name
        $group->name = $groupName;
        $group->save();
        
        //unsubscribe $members to the group
        if(isset($memberIds)){
            foreach($memberIds as $mId){
                $memberObj = \App\User::find($mId);
                if($memberObj->is_inGroup($group->id)){
                    $memberObj->groups()->detach($group->id);
                }
                else {
                    // return false;
                }
            }
        }
        
        // subscribe $friends to the group
        if(isset($friendIds)){
            foreach($friendIds as $fId){
                $friendObj = User::find($fId);
                if(!$friendObj->is_inGroup($group->id)){
                    $friendObj->groups()->attach($group->id);
                }
                else{
                    // return false;
                }
            }
        }
        
       return redirect()->back()->with('message', 'Group \''. $group->name. '\' has been updated successfully!');
    }
    
    public function destroy($id)
    {
        $group = Group::find($id);

        if (isset($group)) {
            // delete all the associated events
            $group->events()->delete();
            
            // delete the group
            $group->delete();
        }
        else {
            return false;
        }

        return redirect()->route('friends.index')->with('messageDanger', '\''. $group->name. '\' has been deleted successfully.');
    }
    
    public function edit($id){
        $group = Group::find($id);
        $members = $group->users()->where('users.id', '<>', \Auth::user()->id)->orderBy('name')->get(); //excl. auth::user
        $friends = \Auth::user()->friends()->whereNotIn('users.id', User::getIds($members))->orderBy('name')->get(); //excl. group members
        
        return view('group.edit', [
            'group' => $group,
            'members' => $members,
            'friends' => $friends,
        ]);
    }
    
    public function leave($id){
        $group = Group::find($id);
        
        if(\Auth::user()->is_inGroup($group->id)){
            \Auth::user()->groups()->detach($group->id);
        }
        else {
            return redirect()->route('friends.index')->with('messageDanger', 'Could not leave \''. $group->name. '\'...');
        }
        
        return redirect()->route('friends.index')->with('message', 'You have left \''. $group->name. '\' successfully.');
    }
    
}

