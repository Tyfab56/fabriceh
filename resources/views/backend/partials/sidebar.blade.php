<div class="sidebar-wrapper" >
	<div class="logo">
		<a href="{{ url('/') }}"><img src="{{ $SettingsData['back_logo'] ? asset('public/media/'.$SettingsData['back_logo']) : asset('public/backend/images/logo.png') }}" alt="logo" /></a>
	</div>
	<ul class="left-main-menu">
		<li><a class="active" href="{{ route('backend.home') }}"><i class="fa fa-home"></i><span>{{ __('Home Page') }}</span></a></li>
		<li><a href="{{ route('backend.about') }}"><i class="fa fa-address-card-o"></i><span>{{ __('About Page') }}</span></a></li>
		<li><a href="{{ route('backend.portfolio') }}"><i class="fa fa-product-hunt"></i><span>{{ __('Portfolio Page') }}</span></a></li>
		<li><a href="{{ route('backend.blog') }}"><i class="fa fa-th"></i><span>{{ __('Blog Page') }}</span></a></li>
		<li><a href="{{ route('backend.contact') }}"><i class="fa fa-location-arrow"></i><span>{{ __('Contact Page') }}</span></a></li>
		<li><a href="{{ route('backend.settings') }}"><i class="fa fa-cogs"></i><span>{{ __('Settings') }}</span></a></li>
		<li><a href="{{ route('backend.langauges') }}"><i class="fa fa-language"></i><span>{{ __('Langauges') }}</span></a></li>
		<li><a href="{{ route('backend.users') }}"><i class="fa fa-users"></i><span>{{ __('Users') }}</span></a></li>
	</ul>
</div>