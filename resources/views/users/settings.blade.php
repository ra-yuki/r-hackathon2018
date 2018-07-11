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
    <li><a href="{{route('settings.settings')}}?layout=1">Cool</a></li>
    <li><a href="{{route('settings.settings')}}?layout=2">Cute</a></li>
    <li><a href="{{route('settings.settings')}}?layout=3">Happy</a></li>
  </ul>
</div>
    </div>
@endsection