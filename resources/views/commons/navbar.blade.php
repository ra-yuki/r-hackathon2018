<nav class="navbar navbar-default navbar-static-top">
	<div class="container-fluid">
		<!--<div class="navbar-header">-->
			<button type="button" class="navbar-toggle collapsed"data-toggle="collapse"data-target="#navbarEexample10">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
		<!--</div>-->
		<a  class="navbar-brand" href="/"> Medium rare </a>
		
			<ul class="nav navbar-nav navbar-right">
			    <div class="dropdown">
			        <button class=" dropdown-toggle"  data-toggle="dropdown">
		                Add plans
		                <span class="caret"></span>
	                </button>
                	<ul class="dropdown-menu" role="menu">
                		<a href="{{route('events.showSchedulePrivateEvent')}}" id="toop">+ Private Event </a>
                		<a href="{{route('events.showScheduleGroupEvent')}}" id="toop">+ Group Event </a>
                	</ul>
			    </div>
			     
			     <div class="dropdown">
			        <button class=" dropdown-toggle"  data-toggle="dropdown">
		                Friends
	                </button>
                	<ul class="dropdown-menu" role="menu">
                		<a class="navbar-left" href="/makegroup" id="toop">Makegroup </a>
                		<a class="navbar-left" href="/friends" id="toop">Groups/Friends </a>
                	</ul>
			    </div>
			        
			        <div class="dropdown">
			        <button class=" dropdown-toggle"  data-toggle="dropdown">
		                Settings
	                </button>
                	<ul class="dropdown-menu" role="menu">
                		<a class="navbar-left" href="{{route('settings.settings')}}" id="toop">Settings</a>
                		<p>Profile</p>
                		@if (Auth::check())
                                <a href="{{ route('logout.get') }}" class="bt"><div id="a">Log out</div></a>
                            @else
                            @endif
                        
                	</ul>
			    </div>
				<a class="navbar-left" href="/user" id="toop">Search </a>
			
			</ul>
		
	</div>
</nav>