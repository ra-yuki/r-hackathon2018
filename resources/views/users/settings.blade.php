@extends('layouts.app')

@section('head-plus')
    <link rel="stylesheet" href="{{ secure_asset('css/commons/buttons.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/commons/generals.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="text-center" id="change">
                <p>Change the theme</p>
            </div>
        </div>
        <div class="col-xs-12 col-md-offset-2 col-md-4 mt-2">
            <button type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown" id="theme">
                Color
            </button>
    
            <!-- choices -->
            <ul class="dropdown-menu">
                <!--<li><a href="{{route('settings.changeTheme')}}?layout=1">original</a></li>-->
                <li><a href="{{route('settings.changeTheme')}}?layout=2">original</a></li>
                <li><a href="{{route('settings.changeTheme')}}?layout=3">pink</a></li>
                <li><a href="{{route('settings.changeTheme')}}?layout=4">beige</a></li>
                <!--<li><a href="{{route('settings.changeTheme')}}?layout=5">navy</a></li> -->
            </ul>
        </div>
        
        <div class="col-xs-12 col-md-4 mt-2">
            <div class="dropdown">
                <button type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown" id="theme">
                    Theme
                </button>
                <!-- choices -->
                <ul class="dropdown-menu">
                    <li><a href="{{route('settings.changeTheme')}}?layout=6">flower</a></li>
                    <li><a href="{{route('settings.changeTheme')}}?layout=7">fruits</a></li>
                    <li><a href="{{route('settings.changeTheme')}}?layout=8">beach</a></li>
                    <!--<li><a href="{{route('settings.changeTheme')}}?layout=9">galaxy</a></li>-->
                    <!--<li><a href="{{route('settings.changeTheme')}}?layout=10">snow</a></li>-->
                    <li><a href="{{route('settings.changeTheme')}}?layout=11">newyork</a></li>
                    <li><a href="{{route('settings.changeTheme')}}?layout=12">cafe</a></li>
                    <li><a href="{{route('settings.changeTheme')}}?layout=13">star</a></li>
                    <!--<li><a href="{{route('settings.changeTheme')}}?layout=14">neon</a></li>-->
                </ul>
            </div>
        </div>
    </div>
@endsection