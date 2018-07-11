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
  </ul>
</div>
<link href="https://fonts.googleapis.com/css?family=Cabin+Sketch|Covered+By+Your+Grace|Julius+Sans+One|Neucha|Patrick+Hand|Roboto+Condensed|Rokkitt" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Covered+By+Your+Grace|Neucha|Patrick+Hand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Covered+By+Your+Grace|Neucha|Patrick+Hand|Roboto+Condensed|Rokkitt" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Covered+By+Your+Grace|Julius+Sans+One|Neucha|Patrick+Hand|Roboto+Condensed|Rokkitt" rel="stylesheet">
    </div>
@endsection