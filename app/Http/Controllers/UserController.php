<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Libraries\Config;

class UserController extends Controller
{
    public function index(Request $request){
        #キーワード受け取り
        $keyword = $request->userId;
     
        #もしキーワードがあったら
        $res = [];
        if(!empty($keyword))
        {
            $res = \App\User::where([
                ['name', 'like', "%$keyword%"],
                ['id', '<>', \Auth::user()->id],
            ])->orderBy('name')->get();
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