<header>
@if (Auth::check())

<div class="nav3">
<nav class="navbar navbar-default" id="navbar">
  <link href="https://fonts.googleapis.com/css?family=Asap+Condensed%7CCabin+Sketch%7CFredericka+the+Great%7CRammetto+One" rel="stylesheet">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <a class="navbar-brand" href="/" id="popcorn">POPCON</a><img src="{{secure_asset('images/ppp.png')}}" id="tobi">
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a class="navbar-left" href="/mypage"><img src="{{secure_asset('images/home.png')}}" id="home"><br>my page </a></li>
        
        <li>
          <a class="navbar-left" href="{{ route('friends.index') }}">
            <img src="{{secure_asset('/images/add-user (1) (1).png')}}" id="fr"><br>
            &nbsp;friends
          </a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{secure_asset('images/calendar.png')}}" id="ca"><br>add plans <span class="caret"></span></a>
          <ul class="dropdown-menu" id="dp">
            <li><a class="navbar-left" href="{{route('events.showScheduleInPrivate')}}" >Private Event </a></li>
            <li><a class="navbar-left" href="{{route('events.showScheduleWithGroup')}}">Group Event </a></li>
          </ul>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{secure_asset('images/settings.png')}}" id="set"><br>settings <span class="caret"></span></a>
          <ul class="dropdown-menu" id="dp">
            <li><a class="navbar-left" href="{{ route('profile.index') }}">Profile </a></li>
            <li><a class="navbar-left" href="{{route('settings.settings')}}" >Layouts</a></li>
            <li><a href="{{ route('logout.get') }}">Log out</a></li>
          </ul>
        </li>
        <li><a class="navbar-left" href="/introduction"><img src="{{secure_asset('images/question.png')}}" id="q"><br><p>help</p> </a></li>
      </ul>
      

      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>

@else
                    
@endif

</header>