@extends('layouts.app')

@section('content')

    <div class="row">
   <div class="dropdown">
       <p>Change the theme</p>
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Theme
  </button>
  <!-- choices -->
  <ul class="dropdown-menu">
    <li><a href="{{route('settings.changeTheme')}}?layout=1">Ocean</a></li>
    <li><a href="{{route('settings.changeTheme')}}?layout=2">Cute</a></li>
    <li><a href="{{route('settings.changeTheme')}}?layout=3">Happy</a></li>
    <li><a href="{{route('settings.changeTheme')}}?layout=4">Natural</a></li>
     <li><a href="{{route('settings.changeTheme')}}?layout=4">Erika</a></li> 
     <li><a href="{{route('settings.changeTheme')}}?layout=4">Mihan</a></li>
      <li><a href="{{route('settings.changeTheme')}}?layout=4">Miyu</a></li>
       <li><a href="{{route('settings.changeTheme')}}?layout=4">So</a></li>
  </ul>
</div>

    </div>
@endsection