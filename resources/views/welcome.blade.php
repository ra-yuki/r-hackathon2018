@extends('layouts.app')

@section('head-plus')
    <link rel="stylesheet" href="{{secure_asset('css/commons/buttons.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/welcome.css')}}">
    
@endsection

@section('content')
<div id="wrapper-container">
    <div id="top-cover" class="col-xs-12 bg-red">
        <h1 class="ml1">
            <span class="text-wrapper">
            <span class="line line1"></span>
            <span class="letters">POPCON</span>
            <span class="line line2"></span>
            </span>
        </h1>
        <!--<h1 class="text-center">POPCON</h1>-->
        <h3 class="text-center">Adjust Your Schedule, Quicker Than Ever</h3>
        <p class="text-center">
            <a href="{{ route('signup.get') }}" class="col-xs-offset-4 col-xs-2 square_btn">SIGNUP</a>
            <a href="{{ route('login') }}" class="col-xs-2 square_btn">LOGIN</a>
        </p>
    </div>
    <div id="top-welcome" class="col-xs-12 bg-green">
        <div class="col-xs-offset-3 col-xs-6">
            <h2 class="text-center">WELCOME TO POPCON</h2>
            <p class="text-center">POPCON will lead you to a whole new way of scheduling by automatically picking the best date for you. <br>NO MORE 調整さん, HELLO POPCON</p>
            
        </div>
    </div>
    
    <div id="hiw" class="col-xs-12 bg-blue">
        <div class="container">
            <h1 class="text-center">HOW POPCON WORKS</h1><br>
            
            <div class="col-xs-12 col-md-4">
                <p class="text-center"><img src="{{secure_asset('/images/customer.png')}}"></p>
                <p>Form a group with friends that you would like to make plans with.</p>
            </div>
            
            <div class="col-xs-12 col-md-4">
                <p class="text-center"><img src="{{secure_asset('/images/loupe.png')}}"></p>
                <p>It will automatically caluculate each others available days and you will be able to select it.</p>
            </div>
            
            <div class="col-xs-12 col-md-4">
                <p class="text-center"><img src="{{secure_asset('/images/check-mark-button.png')}}"></p>
                <p>Click the confirm button and your plans will be reflected on your Calendar.</p>
            </div>
        </div>
        
    </div>
    
    
    <div id="bottom-welcome" class="col-xs-12 bg-red">
        <h1 class="text-center">WHAT ARE YOU WAITING FOR?</h1>
        <p class="text-center">
            <a href="{{ route('signup.get') }}" class="col-xs-2 col-xs-offset-5 square_btn">SIGNUP</a>
        </p>
    </div>
    
    @include('commons.footer')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="{{ secure_asset('js/test.js') }}"></script>
@endsection

