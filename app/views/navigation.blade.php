<!-- Static navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Conf Sched</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li>{{ link_to('/', 'Home'); }}</li>
				<li>{{ link_to('/process', 'Schedule Process'); }}</li>
				<li>{{ link_to('//cs-sr.academic.roanoke.edu/openconf', 'OpenConf'); }}</li>
				<li>{{ link_to('/committeesourcing', 'Committee Sourcing') }}
				<li>{{ link_to('/authorsourcing', 'Author Sourcing') }}</li>
				<li>{{ link_to('/schedule', 'Schedule') }}</li>
				<!-- <li><a href="#">Link</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Nav header</li>
						<li><a href="#">Separated link</a></li>
						<li><a href="#">One more separated link</a></li>
					</ul> -->
				<!-- </li> -->
			</ul>
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::guest())
					<li>{{ link_to('/signup', 'Sign Up') }}</li>
					<li>{{ link_to('/login', 'Log In')}}</li>
				@else
					<li>{{ link_to('/logout', 'Logout ' . Auth::user()->username) }}</li>
				@endif
			</ul>
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</div>