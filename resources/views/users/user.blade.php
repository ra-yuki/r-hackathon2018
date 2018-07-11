@extends('layouts.app')

@section('content')

<div class="container-fluid">
<div class="row">
 
<!--↓↓ 検索フォーム ↓↓-->

<form class="form-inline" action="{{route('user.index')}}">
  <div class="form-group">
  <input type="text" name="userId" value="{{$userId}}" class="form-control" placeholder="Search New Friends">
  </div>
  <input type="submit" value="Search" class="btn">
</form>

<!--↑↑ 検索フォーム ↑↑-->
 

@if (count($SearchResult) > 0)
<ul class="media-list">
@foreach ($SearchResult as $user)
    <li class="media">
       
        <div class="media-body">
            <div>
                {{ $user->name }}
            </div>
            @include('users.addbutton', ['user' => $user])
            <div>
                {{-- <p>{!! link_to_route('users.show', 'View profile', ['id' => $user->id]) !!}</p> --}}
            </div>
        </div>
    </li>
@endforeach
</ul>

@endif

</div>
</div>

@endsection