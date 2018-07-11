<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
class GroupsController extends Controller
{
   
   function index(){
        // searching groups...
        #キーワード受け取り
        $keyword = (isset($_GET['groupId'])) ? $_GET['groupId'] : null;
     
        #もしキーワードがあったら
        $res = null;
        if(!empty($keyword))
        {
            $res = \Auth::user()->groups()->where('name', 'like', "%$keyword%")->get();
        }
        # キーワードないときは全group取得
        else{
            $res = \Auth::user()->groups;
        }
        
        return view('users.friends', [
         'groupId' => $keyword, 
         'groups' => $res,
         'friendId' => '',
         'friends' => \Auth::user()->friends,
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
