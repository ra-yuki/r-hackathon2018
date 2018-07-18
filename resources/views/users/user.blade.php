@extends('layouts.app')
@section('head-plus')
<link rel="stylesheet" href="{{ secure_asset('css/user-user.css') }}">
<link rel="stylesheet" href="{{ secure_asset('css/commons/buttons.css') }}">
<script>
    var usersImages = new Array();
    var usersIds = new Array();
    var usersNames = new Array();
    @if(count($SearchResult) > 0)
        @foreach($SearchResult as $key => $r)
            usersImages[{{$r->id}}] = '{{$r->imageUrl}}';
            usersIds[{{$r->id}}] = {{$r->id}};
            usersNames[{{$r->id}}] = '{{$r->name}}';
        @endforeach
    @endif
</script>
<script src="{{ secure_asset('js/displayUser.js') }}"></script>
<!-- $imageUrl = Config::AVATAR_DEFAULT_URLS[$user->id % count(Config::AVATAR_DEFAULT_URLS)]; -->
@endsection
@section('content')

<div class="container">
    <div class="col-xs-5">
        <!--↓↓ 検索フォーム ↓↓-->
        
        <form class="form-inline" action="{{route('user.index')}}">
          <div class="form-group">
          <input type="text" name="userId" value="{{$userId}}" class="form-control" placeholder="Search New Friends">
          </div>
            <button id="search-button"class="btn btn-grey"><span class="glyphicon glyphicon-search"></span></button>
        </form>
    
        <!--↑↑ 検索フォーム ↑↑-->
    
    
        @if (count($SearchResult) > 0)
        <ul class="media-list">
        @foreach ($SearchResult as $user)
            <li class="media">
               
                <div class="media-body">
                    <div>
                       {{--<a href="{{route('friends.show',['id'=>$user->id])}}"> {{ $user->name }} </a>--}}
                       <a onclick="displayUser('{{$user->id}}')">{{$user->name}}</a>
                    </div>
                    @include('users.addbutton', ['user' => $user])
                </div>
            </li>
        
        @endforeach
        </ul>
    
        @endif

    </div>
    <div id="user-detail" class="col-xs-7">
        <div id="user-image" class="">
            <!-- <img> -->
        </div>
        <h1 id="user-name" class="text-center">
            <!-- user name -->
        </h1>
        <div id="user-add">

        </div>
    </div>
</div>

@endsection