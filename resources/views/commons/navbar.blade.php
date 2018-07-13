<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

<header>
@if (Auth::check())

<div class="nav3">
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
        <li><a class="navbar-left" href="/user">Search </a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add Plans <span class="caret"></span></a>
          <ul class="dropdown-menu" id="dp">
            <li><a class="navbar-left" href="{{route('events.showSchedulePrivateEvent')}}" >Private Event </a></li>
            <li><a class="navbar-left" href="{{route('events.showScheduleGroupEvent')}}">Group Event </a></li>
          </ul>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Friends<span class="caret"></span></a>
          <ul class="dropdown-menu" id="dp">
            <li><a class="navbar-left" href="/friends">Groups/Friends </a></li>
            <li><a class="navbar-left" href="/makegroup">Makegroup </a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu" id="dp">
            <li>Profile</li>
            <li><a class="navbar-left" href="{{route('settings.settings')}}" >Layouts</a></li>
            <li><a href="{{ route('logout.get') }}">Log out</a></li>
          </ul>
        </li>
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>

@else
                    
@endif

</header>