@extends('layouts.app')

@section('cover')
@endsection

@section('content')
    <div class="cover" id="topall">
        <div class="cover-inner">
            <div class="cover-contents">

                <h1 class="ml1">
                    <span class="text-wrapper">
                    <span class="line line1"></span>
                    <span class="letters">CALENDAR</span>
                    <span class="line line2"></span>
                    </span>
                </h1>
                
                <p class="p">Everyone's schedules on one calender</p>


                <div class="row">
                    <div class="col-xs-2 col-xs-offset-1 col-sm-3 col-sm-offset-3 col-lg-4 col-lg-offset-2">
                        <a href="{{ route('signup.get') }}" id="a" class="col-xs-12">Sign Up</a>
                    </div>
                      
                    <div class="col-xs-2 col-xs-offset-1 col-sm3 col-lg-4">  
                        <a href="{{ route('login') }}" id="b" class="col-xs-12">Log In</a>
                    </div>

               
            </div>
            
        </div>
        <a href="#" id="what" class="col-xs-12">What is CALENDER?</a>
      
        
    </div>

  @include('commons.footer')


<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="{{ secure_asset('js/test.js') }}"></script>     
@endsection