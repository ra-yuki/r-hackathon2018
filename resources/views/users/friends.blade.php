@extends('layouts.app')

@section('head-plus')
<link rel="stylesheet" href="{{ secure_asset('css/commons/spaces.css') }}">
<link rel="stylesheet" href="{{ secure_asset('css/commons/buttons.css') }}">
<script>
    // friend stuffs
    var usersImages = new Array();
    var usersIds = new Array();
    var usersNames = new Array();
    var routeAddFriend = "{{route('add.get', ['id' => '@split'])}}";
    var routeDeleteFriend = "{{route('unfriend', ['id' => '@split'])}}";
    @if(count($friends) > 0)
        @foreach($friends as $key => $r)
            usersImages[{{$r->id}}] = '{{$r->getImageUrl()}}';
            usersIds[{{$r->id}}] = {{$r->id}};
            usersNames[{{$r->id}}] = '{{$r->name}}';
        @endforeach
    @endif
    
    // group stuffs
    var groupsImages = new Array();
    var groupsIds = new Array();
    var groupsNames = new Array();
    var routeEditGroup = "{{route('makegroup.edit', ['id' => '@split'])}}";
    var routeShowGroup = "{{route('groups.show', ['id' => '@split'])}}";
    @if(count($groups) > 0)
        @foreach($groups as $key => $r)
            groupsImages[{{$r->id}}] = '{{$r->getImageUrl()}}';
            groupsIds[{{$r->id}}] = {{$r->id}};
            groupsNames[{{$r->id}}] = '{{$r->name}}';
        @endforeach
    @endif
    
</script>
<script src="{{ secure_asset('js/displayUser.js') }}"></script>
@endsection

@section('content')

{{-- display friends and groups --}}

<div class="container">
    @include('commons.messages')
    
    <div class="col-xs-12 col-md-6">
        {{-- friend/group tag --}}
        <ul class="nav nav-tabs" id="tab">
            <li class="active"><a data-toggle="tab" href="#friend">Friends</a></li>
            <li><a data-toggle="tab" href="#group">Groups</a></li>
        </ul>
        
        {{-- tab content starts here --}}
        <div class="tab-content">
            {{-- Friends Main --}}
            <div id="friend" class="tab-pane fade in active">
                <h3>Friends</h3>
                
                {{-- ↓↓ 検索フォーム ↓↓ --}}
                <form class="form-inline" action="{{route('friends.index')}}">
                    <div class="form-group">
                        <input type="text" name="friendId" value="{{$friendId}}" class="form-control" placeholder="Search Friends">
                    </div>
                    <button id="search-button"class="btn btn-grey"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                <br>
                {{-- ↑↑ 検索フォーム ↑↑ --}}
                
                <p><a href="{{ route('user.index') }}" class="no-decoration"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Find New Friends</a></p>
                @foreach ($friends as $friend)
                    <?php $isFriend = \Auth::user()->is_friend($friend->id); ?>
                    <p>
                        <img class="img-circle" src="{{$friend->getImageUrl()}}" alt="" style="width:50px;">
                        <a href="#" class="no-decoration" onclick="displayUser('{{$friend->id}}', {{ $isFriend }})">{{$friend->name}}</a>
                    </p>
                @endforeach
            </div>
            
            {{-- Group Main --}}
            <div id="group" class="tab-pane fade">
                <h3>Groups</h3>
                <p><a href="{{ route('makegroup.index') }}" class="no-decoration"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Create a New Group</a></p>
                @foreach ($groups as $group)
                    <?php $userNames = []; ?>
                    @foreach($group->users()->orderBy('name')->get() as $key => $u)
                        <?php $userNames[$key] = $u->name; ?>
                    @endforeach
                    <?php $userNamesJson = json_encode($userNames); ?>
                    <p>
                        <img class="img-circle" src="{{$group->getImageUrl()}}" alt="" style="width:50px;">
                        <a href="#" class="no-decoration" onclick="displayGroup('{{$group->id}}', '{{$userNamesJson}}')">{{$group->name}}</a>
                    </p>
                @endforeach
            </div>
        </div>
        {{-- tab content ends here --}}
    </div>
    
    <div id="user-detail" class="col-xs-12 col-md-6 pad-top-m">
        <div id="user-image" class="">
            <!-- <img> -->
        </div>
        <div id="user-name" class="text-center">
            <!-- user name -->
        </div>
        <div id="member-list" class="col-xs-12"></div>
        <div id="user-add" class="col-xs-12">

        </div>
    </div>
</div>

@endsection