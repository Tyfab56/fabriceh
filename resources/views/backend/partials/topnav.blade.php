	
<!--Top Navbar-->
<nav class="navbar-expand-lg navbar tp-header">
	<span class="menu-toggler" id="menu-toggle">
		<span class="line"></span>
	</span>
	<div class="dropdown ml-auto mt-2 mt-lg-0">
		<a href="javascript:void(0);" class="my-profile-info" data-toggle="dropdown">
			<div class="avatar">
				<img src="{{ Auth::user()->image ? asset('media/'.Auth::user()->image) : asset('backend/images/avatar.jpg') }}" alt="avatar" />
			</div>
			<div class="my-profile">
				<span>{{ Auth::user()->name }}</span>
				<span>{{ Auth::user()->email }}</span>
			</div>
		</a>
		<div class="dropdown-menu dropdown-menu-right my-profile-nav">
			<a class="dropdown-item" href="{{ route('backend.profile') }}">{{ __('My Profile') }}</a>
			<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
				{{ __('Logout') }}
			</a>

			<form class="display-none" id="logout-form" action="{{ route('logout') }}" method="POST">
				@csrf
			</form>	
		</div>
	</div>
</nav><!--/Top Navbar/-->
	