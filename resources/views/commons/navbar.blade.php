<header>
 @if (Auth::check())
<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
            </button>
           	
           	
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        	<ul class="nav navbar-defult">
        	 <a  class="navbar-brand" href="/"> Medium rare </a>
        	 <a class="navbar-left" href="/user" id="toop">Search </a>
	
			
			    <div class="dropdown">
			        <button class=" dropdown-toggle"  data-toggle="dropdown">
		                Add plans
	                </button>
                	<ul class="dropdown-menu" >
                		<a href="{{route('events.showSchedulePrivateEvent')}}" id="toop">+ Private Event </a>
                		<a href="{{route('events.showScheduleGroupEvent')}}" id="toop">+ Group Event </a>
                	</ul>
			    </div>
			     
			     <div class="dropdown">
			        <button class=" dropdown-toggle"  data-toggle="dropdown">
		                Friends
	                </button>
                	<ul class="dropdown-menu" >
                		<a class="navbar-left" href="/makegroup" id="toop">Makegroup </a>
                		<a class="navbar-left" href="/friends" id="toop">Show Friends/Groups </a>
                	</ul>
			    </div>
			    
			    	<div class="dropdown">
			        <button class=" dropdown-toggle"  data-toggle="dropdown">
		                Settings
	                </button>
                	
                	<ul class="dropdown-menu" >
                		<a class="navbar-left" href="{{route('settings.settings')}}" id="toop">Settings</a>
                		<p>Profile</p>
                        
                    <a href="{{ route('logout.get') }}" class="bt"><div id="a">Log out</div></a>
                    
                    </ul>
			    </div>
				
		
			</ul>
		
        
	</div>
</nav>
@else
                    
@endif
</header>