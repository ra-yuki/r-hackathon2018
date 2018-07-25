@extends('layouts.app')
@section('head-plus')
    <!-- reading layout here -->
    @if(Auth::user()->layout == null)
        <link rel="stylesheet" href ="{{ secure_asset('css/calendar.css') }}">
    @else
        <link rel="stylesheet" href ="{{ asset('css/calendar-'. Auth::user()->layout.'.css') }}">
    @endif
    
    <link rel="stylesheet" href ="{{ secure_asset('css/commons/intro.css') }}">
@endsection
@section('content')

<div id="wrapper-top" class="container">
<p class="yokoso">Welcome To POPCON</p>
<h1>POPCONについて</h1>
<p>POPCONは次世代のスケジューリングサービスである。<br>ユーザーの要望に合わせて、グループの中で最も参加人数の多い日程を自動算出することができる。</p><br><br>
 
 <h2>POPCONでできること</h2>
 <p>1.個人の予定を"Private Event"でたてることができる。</p>
  <p>2.友達を追加し、グループを組むことができる。</p>
 <p>3.グループの中でベストな日程がわかり、共通の予定をたてることができる。</p>
 <p>4.プロフィール画像やレイアウトを自分好みに変えることができる。</p>
 
 
 <h3>1.個人の予定をたてる</h3>
 <p>ナビバーの"add plans"の"Private Event"、もしくは、Mypageのカレンダーの日程から直接入力することができる。</p>
 
 <div id="explain">
     
 <h3>2.友達の追加/グループの作成</h3>
  <h4>友達の追加</h4>
始めに、ナビバーにある<img src="{{secure_asset('/images/add-user (1) (1).png')}}" class="aaa">"friends"にいく。<br>
そして"Find new friends"を押して自分の友達を検索し、追加する。
 <br>
 
 <h4>グループの作成</h4>
ナビバーの<img src="{{secure_asset('/images/add-user (1) (1).png')}}"  class="aaa"> "friends"にいき "Group"タブを押す。
 <br>
 "Make a new group"でグループを作ることができる。
 
<h3>3.グループの予定作成</h3>
 
 ナビバーの<img src="{{secure_asset('/images/add-user (1) (1).png')}}"  class="aaa"> "add plans" の "Group Event"、もしくは、Groupリストから予定を入力することができる。
<br>そうすると、POPCONが自動的に各々の予定から都合のいい日を見つけ出す。<br>
※Date fromとDate toの意味:自分とグループの皆が予定を組みたい期間を選択できる。

</div>

<!--<h2>Mypageの見方</h2>-->
<!--<p class="ime"><img src="{{secure_asset('/images/setumei.PNG')}}" class="aaa"></p>-->


<a href="/mypage"><p class="sa">さっそく始めてみよう</p></a>
 </div>
@endsection