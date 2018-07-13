@extends('layouts.app')

@section('content')

    <div class="row">
   <div class="dropdown">
       <p>Change the theme</p>
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="theme">
    Color
  </button>

  <!-- choices -->
  <ul class="dropdown-menu">
    <li><a href="{{route('settings.changeTheme')}}?layout=1">original</a></li>
    <li><a href="{{route('settings.changeTheme')}}?layout=2">black</a></li>
    <li><a href="{{route('settings.changeTheme')}}?layout=3">pink</a></li>
    <li><a href="{{route('settings.changeTheme')}}?layout=4">beige</a></li>
     <li><a href="{{route('settings.changeTheme')}}?layout=5">aqua</a></li> 
 
  </ul>
</div>

<div class="dropdown">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="theme">
    Theme
  </button>
  <!-- choices -->
  <ul class="dropdown-menu">

     <li><a href="{{route('settings.changeTheme')}}?layout=6">flower</a></li>
     <li><a href="{{route('settings.changeTheme')}}?layout=7">fruits</a></li>
     <li><a href="{{route('settings.changeTheme')}}?layout=8">beach</a></li>
     <li><a href="{{route('settings.changeTheme')}}?layout=9">galaxy</a></li>
     <li><a href="{{route('settings.changeTheme')}}?layout=10">snow</a></li>
     <li><a href="{{route('settings.changeTheme')}}?layout=11">newyork</a></li>
     <li><a href="{{route('settings.changeTheme')}}?layout=12">cafe</a></li>
     <li><a href="{{route('settings.changeTheme')}}?layout=13">beer</a></li>
      <li><a href="{{route('settings.changeTheme')}}?layout=14">neon</a></li>
  </ul>
</div>


    </div>
    
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Yanone+Kaffeesatz" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Gloria+Hallelujah|Yanone+Kaffeesatz" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gaegu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
@endsection