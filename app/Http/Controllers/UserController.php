<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Libraries\Config;

class UserController extends Controller
{
public function index(Request $request)
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
        \Debugbar::info(json_encode($res));
    }       

    return view('users.user', [
        'userId' => $keyword, 
        'SearchResult' => $res,
        'searchResultJson' => json_encode($res),
    ]);
}
 
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

}