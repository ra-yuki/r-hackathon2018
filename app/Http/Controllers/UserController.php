<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
  }       
  else{
            $res = \Auth::user()->get();
      }
 return view('users.user', [
     'userId' => $keyword, 
     'SearchResult' => $res,
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