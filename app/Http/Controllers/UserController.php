<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Libraries\Config;

class UserController extends Controller
{
<<<<<<< HEAD
public function index(Request $request)
{
    #キーワード受け取り
    $keyword = $request->userId;
 
    #もしキーワードがあったら
    $res = [];
    if(!empty($keyword))
=======
    public function index(Request $request)
>>>>>>> fde0e38fa0cc6d41e0203010cee27fa7f7006aa6
    {
        #キーワード受け取り
        $keyword = $request->userId;
     
        #もしキーワードがあったら
        $res = null;
        if(!empty($keyword))
        {
            $res = \App\User::where('name', 'like', "%$keyword%")->get();
            
            foreach($res as $key => $r){
                if($r->image != null){ //has image
                    $res[$key]->imageUrl = $r->image->url;
                }
                else{ //no image found
                    $res[$key]->imageUrl = Config::AVATAR_DEFAULT_URLS[$r->id % count(Config::AVATAR_DEFAULT_URLS)];
                }
            }
<<<<<<< HEAD
            else{ //no image found
                $res[$key]->imageUrl = Config::AVATAR_DEFAULT_URLS[$r->id % count(Config::AVATAR_DEFAULT_URLS)];
            }
        }
        // \Debugbar::info(json_encode($res));
    }
    

    return view('users.user', [
        'userId' => $keyword, 
        'SearchResult' => $res,
        'searchResultJson' => json_encode($res),
    ]);
}
=======
            \Debugbar::info(json_encode($res));
        }       
    
        return view('users.user', [
            'userId' => $keyword, 
            'SearchResult' => $res,
            'searchResultJson' => json_encode($res),
        ]);
    }
>>>>>>> fde0e38fa0cc6d41e0203010cee27fa7f7006aa6
 
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    public function vote($id){
        \Auth::user()->vote($id);
        
        return redirect()->back();
    }
    
    public function unvote($id){
        \Auth::user()->unvote($id);
        
        \Debugbar::info(\Auth::user()->links);
        
        return redirect()->back();
    }
}