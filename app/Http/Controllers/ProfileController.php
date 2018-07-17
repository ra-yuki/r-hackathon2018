<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
//@added_yukiholi
use App\Image;
use App\Libraries\CloudinaryHelper;
use App\Libraries\Config;
//@endadded_yukiholi

class ProfileController extends Controller
{
    //@comment_yuki
    // index() is more secure option because you could see others profiles from show($id)
    //@endcomment_yuki
    function show($id){
        // $friendId=$request->id;
        // $userinst= new \App\User;
        // $user = $userinst::find($friendId);
        $user = User::find($id);
        
        return view('users.profile', [
            'user' => $user,
        ]);
    }
    
    //@added_yukiholi
    function index(){
        // get user data
        $user = \Auth::user();
        // get avatar image
        $imageUrl = Config::AVATAR_DEFAULT_URLS[$user->id % count(Config::AVATAR_DEFAULT_URLS)];
        if($user->image()->count() > 0) $imageUrl = $user->image->url;
        
        //parse to view
        return view('users.profile_', [
            'user' => $user,
            'imageUrl' => $imageUrl,
        ]);
    }
    
    function uploadImage(Request $request){
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
            $image->userId = \Auth::user()->id; //link to the user
            if($image->save()){ //delete other user images if saved OK
                \Auth::user()->images()->where('id', '<>', $image->id)->delete();
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
        return redirect()->route('profile.index')->with('message', $msg);
    }
    //@endadded_yukiholi
}
