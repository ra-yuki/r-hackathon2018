<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;
use App\Image;
use App\Libraries\CloudinaryHelper;
use App\Libraries\Config;

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
            $res = \Auth::user()->groups()->where([
                ['name', 'like', "%$keyword%"],
                ['visibility' , '=', '1'],
            ])->get();
        }
        # キーワードないときは全group取得
        else{
            $res = \Auth::user()->groups()->where('visibility', '1')->get();
        }
        
        return view('users.friends', [
         'groupId' => $keyword, 
         'groups' => $res,
         'friendId' => '',
         'friends' => \Auth::user()->friends,
        ]);
      
    }
    
    function show($id){
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
    
    public function uploadImage(Request $request, $id){
        $group = Group::find($id);
        
        // var declarations
        $msg = 'ERROR: no message parsed'; // message for the redirecting page
        
        // init cloudinary api
        CloudinaryHelper::init();
        
        // upload input file
        $status = CloudinaryHelper::upload($_FILES, $res);
        if($status == Config::UPLOAD_RETURN_CODES['SuccessfullyPerformed']){
            //store to db
            $image = new Image();
            $image->url = $res->url;
            $image->data = json_encode($res);
            $image->groupId = $group->id; //link to the group
            if($image->save()){ //delete other group images if saved OK
                $group->images()->where('id', '<>', $image->id)->delete();
            }
            //parse to $msgs
            $msg = $_FILES[Config::UPLOAD_TAG_NAME]['name']. " has been uploaded successfully!";
        }
        else { //parse relevant error info to $msg
            foreach(Config::UPLOAD_RETURN_CODES as $key => $val){
                if($status != $val) continue;
                $msg = 'ERROR: '. $key;
                break;
            }
        }
        
        //redirect
        return redirect()->back()->with('message', $msg);
    }
}
