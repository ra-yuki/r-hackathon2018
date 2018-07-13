@extends('layouts.app')

@section('content')

{{-- display friends and groups --}}


<div class="container">

  <ul class="nav nav-tabs" id="tab">
    <li class="active"><a data-toggle="tab" href="#friend">Friends</a></li>
    <li><a data-toggle="tab" href="#group">Groups</a></li>
  </ul>

  <div class="tab-content">
      <div id="friend" class="tab-pane fade in active">
      <h3>Friends</h3>
      {{-- ↓↓ 検索フォーム ↓↓ --}}

<form class="form-inline" action="{{route('friends.index')}}">
  <div class="form-group">
  <input type="text" name="friendId" value="{{$friendId}}" class="form-control" placeholder="Search Friends">
  </div>

 
  <input type="image" src="images/megane2.png" alt="虫眼鏡">

</form>



{{-- ↑↑ 検索フォーム ↑↑ --}}
        @foreach ($friends as $friend)
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="panel panel-default">
                <div>{!! link_to_route('friends.show',$friend->name, ['id' => $friend->id]) !!}</div>
            </div>
        </div>
        @endforeach
    
     </div>
     <div id="group" class="tab-pane fade">
     <h3>Groups</h3>
  {{--   
   ↓↓ 検索フォーム ↓↓ 

<form class="form-inline" action="{{route('groups.index')}}">
  <div class="form-group">
  <input type="text" name="groupId" value="{{$groupId}}" class="form-control" placeholder="Search groups">
  </div>
  <input type="submit" value="Search" class="bt">
</form>

 ↑↑ 検索フォーム ↑↑ 
--}}
      
      @foreach ($groups as $group)
           <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="panel panel-default">
                    <div>
                        {!! link_to_route('groups.show',$group->name, ['id' => $group->id]) !!}
                    </div>
                    
            
                </div>
            </div>
    
@endforeach
      
    </div>
  </div>
</div>

@endsection