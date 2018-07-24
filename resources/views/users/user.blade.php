@extends('layouts.app')
@section('head-plus')

@if(Auth::user()->layout == null)
    <link rel="stylesheet" href ="{{ secure_asset('css/commons/buttons.css') }}">
    <link rel="stylesheet" href ="{{ secure_asset('css/user-user.css') }}">
    <link rel="stylesheet" href ="{{ secure_asset('css/friends.css') }}">
@else
    <link rel="stylesheet" href ="{{ asset('css/commons/buttons-'. Auth::user()->layout.'.css') }}">
    <link rel="stylesheet" href ="{{ asset('css/user-user-'. Auth::user()->layout.'.css') }}">
    <link rel="stylesheet" href ="{{ asset('css/friends-'. Auth::user()->layout.'.css') }}">
@endif


<link rel="stylesheet" href="{{ secure_asset('css/commons/spaces.css') }}">
<script>
    var usersImages = new Array();
    var usersIds = new Array();
    var usersNames = new Array();
    var routeAddFriend = "{{route('add.get', ['id' => '@split'])}}";
    var routeDeleteFriend = "{{route('unfriend', ['id' => '@split'])}}";
    
    @if(count($SearchResult) > 0)
        @foreach($SearchResult as $key => $r)
            usersImages[{{$r->id}}] = '{{$r->getImageUrl()}}';
            usersIds[{{$r->id}}] = {{$r->id}};
            usersNames[{{$r->id}}] = '{{$r->name}}';
        @endforeach
    @endif
</script>
<script src="{{ secure_asset('js/displayUser.js') }}"></script>
@endsection
@section('content')

<div class="container">
    @include('commons.messages')
    
    <h1 class="text-center">Search Users</h1>
    
    <div class="col-xs-12 col-md-6">
        <!--↓↓ 検索フォーム ↓↓<--></-->
        <form class="form-inline" action="{{route('user.index')}}">
          <div class="form-group">
          <input type="text" name="userId" value="{{$userId}}" class="form-control" placeholder="Type User Name">
          </div>
          <button id="search-button"class="btn btn-grey"><span class="glyphicon glyphicon-search"></span></button>
        </form>
        <br>
        <!--↑↑ 検索フォーム ↑↑-->
    
    
        @if (count($SearchResult) > 0)
        <ul class="media-list">
        @foreach ($SearchResult as $user)
            <?php $isFriend = \Auth::user()->is_friend($user->id); ?>
            <li class="media">
               
                <div class="media-body">
                    <div>
                       <p>
                           <img class="img-circle" src="{{$user->getImageUrl()}}" alt="" style="width:50px;">
                           <a href="#" class="no-decoration" onclick="displayUser('{{$user->id}}', {{ $isFriend }})">{{$user->name}}</a>
                       </p>
                    </div>
                </div>
            </li>
        
        @endforeach
        </ul>
    
        @endif

    </div>
    <div id="user-detail" class="col-xs-12 col-md-6 pad-top-m">
        <div id="user-image" class="">
            <!-- <img> -->
        </div>
        <h1 id="user-name" class="text-center">
            <!-- user name -->
        </h1>
        <div id="user-add">

        </div>
        
        <!-- will never use it, but required to make my shitty js run -->
        <div id="member-list"></div>
    </div>
</div>

@endsection