<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<header>
@if (Auth::check())

<nav class="navbar navbar-default" id="navbar">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">MediumRare</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a class="navbar-left" href="/user" id="toop">Search </a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add Plans <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="navbar-left" href="{{route('events.showSchedulePrivateEvent')}}" id="toop">+ Private Event </a></li>
            <li><a class="navbar-left" href="{{route('events.showScheduleGroupEvent')}}" id="toop">+ Group Event </a></li>
          </ul>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Friends<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="navbar-left" href="/friends" id="toop">Groups/Friends </a></li>
            <li><a class="navbar-left" href="/makegroup" id="toop">Makegroup </a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>Profile</li>
            <li><a class="navbar-left" href="{{route('settings.settings')}}" id="toop">Layouts</a></li>
            <li><a href="{{ route('logout.get') }}" class="bt"><div id="a">Log out</div></a></li>
          </ul>
        </li>
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

@else
                    
@endif
</header>