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
                
                <p class="p">Adjust Your Schedule, quicker than ever</p>


                <div class="row">
                    <div class="col-xs-2 col-xs-offset-1 col-sm-3 col-sm-offset-3 col-lg-2 col-lg-offset-4">
                        <a href="{{ route('signup.get') }}" id="a" class="col-xs-12">Sign Up</a>
                    </div>
                      
                    <div class="col-xs-2 col-xs-offset-1 col-sm3 col-lg-2">  
                        <a href="{{ route('login') }}" id="b" class="col-xs-12">Log In</a>
                    </div>

               
            </div>
            
        </div>
    <!--<a href="#" id="what" class="col-xs-12">What is CALENDER?</a>-->
     <div class="top__scroll-box">
  	<a id="what" class="top__scroll" href="#tools">What is CALENDER?</a>
	</div>
					
				
      
        
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" id="slide" data-ride="carousel" data-interval="false">
  <div class="carousel-indicators">
     <div data-target="#carouselExampleIndicators" data-slide-to="0" class="active">&nbsp;&nbsp;&nbsp;&nbsp; Calendar</div>
    <div data-target="#carouselExampleIndicators" data-slide-to="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Share &nbsp;&nbsp; </div>
    <div data-target="#carouselExampleIndicators" data-slide-to="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Memo &nbsp;</div>
  </div>
  
 
  <h1 class="carousel-inner__carousel-item__carousel-item">You can manage your life with this!!</h1>
  
  
  <div class="carousel-inner">
    <div class="carousel-item active">
       
       　<img src="{{secure_asset('images/page1.PNG')}}" alt="m" >
    </div>
    <div class="carousel-item">
　　　
　　　<img src="{{secure_asset('images/page2.PNG')}}" alt="m" width="1270px" height="600px">
    </div>
    <div class="carousel-item">
     　<img src="{{secure_asset('images/page3.PNG')}}" alt="m" width="1270px" height="600px">
    </div>
  </div>
 
</section>

  <!--@include('commons.footer')-->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="{{ secure_asset('js/test.js') }}"></script>   
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
@endsection