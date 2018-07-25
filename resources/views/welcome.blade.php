@extends('layouts.app')

@section('head-plus')
    <link rel="stylesheet" href="{{secure_asset('css/commons/buttons.css')}}">
    <link rel="stylesheet" href="{{secure_asset('css/welcome.css')}}">
     <link rel="shortcut icon" type="image/png" href="/images/favicon.png" />
    
@endsection

@section('content')
<div id="wrapper-container">
   
    <div id="top-cover" class="col-xs-12">

      <div class="popcon">
                <h1 class="ml1">
                    <span class="text-wrapper">
                    <span class="line line1"></span>
                    <span class="letters">POPCON</span>
                    <span class="line line2"></span>
                    </span>
                </h1>
      </div>

        <div class="popcon2">
          <div class="container">
                <h3 class="text-center" id="adjust">Adjust Your Schedule, Quicker Than Ever</h3>
                <p class="text-center">
                    <a href="{{ route('signup.get') }}" class="col-xs-12 col-md-offset-3 col-md-2 square_btn" id="sign">SIGNUP</a>
                    <a href="{{ route('login') }}" class="col-xs-12 col-md-offset-2 col-md-2 square_btn" id="log">LOGIN</a>
                </p> 
          </div>
        </div>
        <p class="sc">SCROLL</p>
       <a href="#welcom"><span class="scroll"></span></a> 
    </div>
    

    <div id="top-welcome" class="col-xs-12">
        
        <div class="col-xs-offset-3 col-xs-6">
            
            
            <h1 class="text-center"><a name="welcom"></a>WELCOME TO POPCON</h1>
            <p class="text-center">POPCON will lead you to a whole new way of scheduling by automatically picking the best date for you. <br>NO MORE 調整さん, HELLO POPCON!</p>
            
        </div>
       
    </div>
    
    
    <div id="hiw" class="col-xs-12">
        <div class="container">
            <h1 class="text-center">HOW POPCON WORKS</h1><br>
           
            <br>
            
            <div class="col-xs-12 col-md-4">
                <p class="text-center"><img src="{{secure_asset('/images/customer.png')}}"></p>
                <p class="text-center">Form a group with friends.</p>
            </div>
            
            <div class="col-xs-12 col-md-4">
                <p class="text-center"><img src="{{secure_asset('/images/loupe.png')}}"></p>
                <p class="text-center">It will automatically caluculate the best day.</p>
            </div>
            
            <div class="col-xs-12 col-md-4">
                <p class="text-center"><img src="{{secure_asset('/images/check-mark-button.png')}}"></p>
                <p class="text-center">Click the "this day" button.</p>
            </div>
        </div>
        
    </div>
    
  
    <div id="bottom-welcome" class="col-xs-12">
        <h1 class="text-center">WHAT ARE YOU WAITING FOR?</h1>
        <br>
        <p class="text-center">
            <a href="{{ route('signup.get') }}" class="col-xs-2 col-xs-offset-5 square_btn">START</a>
        </p>
    </div>
    
    @include('commons.footer')
</div>
<link href="https://fonts.googleapis.com/css?family=Asap+Condensed%7CCabin+Sketch%7CFredericka+the+Great%7CRammetto+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Bungee+Inline" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="{{ secure_asset('js/test.js') }}"></script>
@endsection

