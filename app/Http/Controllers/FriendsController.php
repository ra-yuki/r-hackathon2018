<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class FriendsController extends Controller
{
    function index(){
        // searching friends...
        #キーワード受け取り
        $keyword = (isset($_GET['friendId'])) ? $_GET['friendId'] : null;
     
        #もしキーワードがあったら
        $res = null;
        if(!empty($keyword))
        {
            $res = \Auth::user()->friends()->where('name', 'like', "%$keyword%")->get();
        }
        # キーワードないときは全友達取得
        else{
            $res = \Auth::user()->friends;
        }
        
        return view('users.friends', [
         'friendId' => $keyword, 
         'friends' => $res,
         'groupId' => '',
         'groups' => \Auth::user()->groups()->where('visibility', '1')->get(),
        ]);
    }
    
    function show($id){

        $user = User::find($id);
        
        return view('users.friend_detail', [
            'friend' => $user,
        ]);
    }
    
    public function store(Request $request, $id)
    {
        \Auth::user()->friend($id);
        User::find($id)->friend(\Auth::user()->id);
        return redirect()->back();
    }

    public function delete($id)
    {
        \Auth::user()->unfiend($id);
        User::find($id)->unfriend(\Auth::user()->id);
        return redirect()->back();
    }
    
}
