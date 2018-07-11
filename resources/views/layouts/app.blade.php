<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <!-- CSRF Token -->
<!--    <meta name="csrf-token" content="{{ csrf_token() }}">-->
    

    <!--Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

 <!--Optional theme -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->

 <!--Latest compiled and minified JavaScript -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if(Auth::check() && Auth::user()->layout != null)
        <link rel="stylesheet" href="{{ secure_asset(Auth::user()->layout) }}">
    @else
        <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
    @endif
</head>
<body>
    <div id="app">
        
                        
                    @if (Auth::check())
                        
                <a class="navbar-left" href="/mypage" id="toop" class="bt">Medium-Rare <b>|</b></a>
                
                    @else
                        
                    @endif
            </div>    
           <div id="topbar">
                    @if (Auth::check())
                        
                <a class="navbar-left" href="/user" id="toop">Search <b>|</b></a>
                <a class="navbar-left" href="/friends" id="toop">Groups/Friends <b>|</b></a>
                <a class="navbar-left" href="/makegroup" id="toop">Makegroup <b>|</b></a>
                {{-- <a class="navbar-left" href="{{route('events.index')}}" id="toop">View Events <b>|</b></a> --}}
                <a class="navbar-left" href="{{route('events.showSchedulePrivateEvent')}}" id="toop">+ Private Event <b>|</b></a>
                <a class="navbar-left" href="{{route('events.showScheduleGroupEvent')}}" id="toop">+ Group Event <b>|</b></a>
                 <a class="navbar-left" href="{{route('settings.settings')}}" id="toop">Settings<b>|</b></a>
                
                    @else
                        
                    @endif
 
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
                     @if (Auth::check())
                        
                 <a href="{{ route('logout.get') }}" class="bt"><div id="a">Log out</div></a>
                
                    @else
                        
                    @endif
                    
                    
     @if (Auth::check())
                        
                 @include('commons.footer')
                
                    @else
                        
                    @endif
      
           
</body>
</html>
