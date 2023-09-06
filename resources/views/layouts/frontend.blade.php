@php
$SettingsData = gSettings();
@endphp


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- SEO -->
	<title>@yield('title')</title>
	@yield('meta-content')
	<!-- favicon icon -->
	<link rel="shortcut icon" href="{{ $SettingsData['favicon'] ? asset('media/'.$SettingsData['favicon']) : asset('frontend/images/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ $SettingsData['favicon'] ? asset('media/'.$SettingsData['favicon']) : asset('frontend/images/favicon.ico') }}" type="image/x-icon">
	<!-- google fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
	<!-- CSS -->
	<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}"> 
	<link rel="stylesheet" href="{{asset('frontend/css/normalize.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/css/animate.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/css/simplebar.css')}}"/>
	<link rel="stylesheet" href="{{asset('frontend/css/lity.css')}}"/>
	<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
	<!-- Theme color change in settings menu -->
	<style type="text/css">
	body, .btn.black-btn, .resume-items .item .bullet, .tw-loader, .contact-form input, .contact-form textarea{background: {{$SettingsData['color']->theme_background_color}};}
	body, a, a:visited, a:active, p, p a, .navbar-expand-md .navbar-nav .nav-link, ul.social-icons li a, .btn.black-btn, .tp-btn-close i, .page-title .subtitle, .page-title .subtitle a, .item-info h3, .item-info h3 > a, .item-info a span, .blog-content .blog-meta span, .contact-info .info, .barfiller .tip, .blog-content .blog-meta span, .single-blog .blog-meta span, .contact-form input, .contact-form textarea, .contact-form input:focus, .contact-form textarea:focus, .contact-info .info, .entry ol li, .entry ul li, .entry ol li a, .entry ul li a, .entry .blockquote pre, .entry pre, .entry .table-bordered td, .entry .table-bordered th {color: {{$SettingsData['color']->theme_text_color}};}
	.tw-ellipsis .load-dot, .barfiller, .item-info a:hover span {background: {{$SettingsData['color']->theme_text_color}};}
	.btn.black-btn, .resume-items .item::before, .resume-items .item .bullet, .contact-form input:focus, .contact-form textarea:focus, .entry .blockquote, .entry pre {border-color: {{$SettingsData['color']->theme_text_color}};}
	p a:hover, a:hover, a:focus, .navbar-expand-md .navbar-nav .active .nav-link, .navbar-expand-md .navbar-nav .nav-link:hover, .btn.black-btn:hover, .blog-content .blog-title a:hover, .entry ol li a:hover, .entry ul li a:hover {color: {{$SettingsData['color']->theme_hover_color}};}
	h1, h2, h3, h4, h5, h6, .blog-content .blog-title a, .page-title h1.title a {color: {{$SettingsData['color']->theme_heading_color}};}
	.item-info a:hover span {color: {{$SettingsData['color']->theme_background_color}};}
	.home-overlay::before, .item-box::before {background: {{$SettingsData['color']->hp_background_color}};}
	.avatar img, .info-image img, .info-content, .item-info a span, .recent-post-heading {border-color: {{$SettingsData['color']->avater_border_color}};}
	.tp-btn-close {background: {{$SettingsData['color']->avater_border_color}};}
	.barfiller .fill, .barfiller .tip {background: {{$SettingsData['color']->fill_color}};}
	.barfiller .tip:after {border-color: {{$SettingsData['color']->fill_color}} transparent;}
	.contact-form input, .contact-form textarea, .contact-info .info .icon {border-color: {{$SettingsData['color']->fill_color}};}
	@media (max-width: 767px) {
		.navbar .menu-toggler .line, .navbar .menu-toggler .line::before, .navbar .menu-toggler .line::after {background: {{$SettingsData['color']->theme_heading_color}};}
		.navbar .navbar-collapse .navbar-nav {background: {{$SettingsData['color']->theme_background_color}};}	
	}
	@media only screen and (min-width: 480px) and (max-width: 767px) {
		.navbar .menu-toggler .line, .navbar .menu-toggler .line::before, .navbar .menu-toggler .line::after {background: {{$SettingsData['color']->theme_heading_color}};}
		.navbar .navbar-collapse .navbar-nav {background: {{$SettingsData['color']->theme_background_color}};}	
	}
	</style>
</head>
<body>
	<!--loader-->
	<div class="tw-loader">
		<div class="preloader-block">
			<div class="tw-ellipsis">
				<span class="load-dot load-dot-1"></span>
				<span class="load-dot load-dot-2"></span>
				<span class="load-dot load-dot-3"></span>
				<span class="load-dot load-dot-4"></span>
			</div>						
		</div>						
	</div><!--/loader/-->
   <!--Navbar-->
	<nav class="navbar-expand-md navbar fixed-top navbar-fixed">
		<a class="navbar-brand" href="{{ url('/') }}">
			<img class="img-logo" src="{{ $SettingsData['front_logo'] ? asset('media/'.$SettingsData['front_logo']) : asset('frontend/images/logo.png') }}" alt="logo"/>
		</a>
		<span class="menu-toggler ml-auto" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" role="button">
			<span class="line"></span>
		</span>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a></li>
				<li class="nav-item"><a class="nav-link" href="#about">{{ __('About') }}</a></li>
				<li class="nav-item"><a class="nav-link" href="#portfolio">{{ __('Portfolio') }}</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ url('bwr') }}">{{ __('BWR') }}</a></li>
				<li class="nav-item"><a class="nav-link" href="#blog">{{ __('Blog') }}</a></li>
				<li class="nav-item"><a class="nav-link" href="{{ url('newsroom') }}">{{ __('Newsroom') }}</a></li>
				<li class="nav-item"><a class="nav-link" href="#contact">{{ __('Contact') }}</a></li>
			</ul>
		</div>
	</nav>	

	<!--/Navbar/-->
	<!--Home Section-->
	@if($SettingsData['home_page'] == 'image_background')
	<section class="home-section home-screen home-overlay" style="background-image:url({{ $background_image ? asset('media/'.$background_image) : asset('frontend/images/home-bg.jpg') }});">
	@elseif($SettingsData['home_page'] == 'particle_background')
	<section class="home-section home-screen home-overlay" style="background-image:url({{ $background_image ? asset('media/'.$background_image) : asset('frontend/images/home-bg.jpg') }});">
	<div id="particles-js"></div>
	@elseif($SettingsData['home_page'] == 'video_background')
	<section class="jarallax home-section home-screen home-overlay" data-jarallax-video="{{ $video_background ? $video_background : 'https://www.youtube.com/watch?v=Hot6gzJxF_I'}}">
	@elseif($SettingsData['home_page'] == 'water_fade_background')
	<section class="home-section home-screen home-overlay ripple" style="background-image:url({{ $background_image ? asset('media/'.$background_image) : asset('frontend/images/home-bg-1.jpg') }});">
	@endif

	@yield('content')
    <!--fermer la section dans le yield-->
	<div class="cookie_consent_card active">
		<span class="cookie_consent_text">Your experience on this site will be improved by allowing cookies.</span>
		<button class="accept_btn">Allow Cookies</button>
	</div>

<!-- JS -->
<script src="{{asset('frontend/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.animatedheadline.min.js')}}"></script>
@if($SettingsData['home_page'] == 'particle_background')
<script src="{{asset('frontend/js/particles.min.js')}}"></script>
<script src="{{asset('frontend/js/app.js')}}"></script>
@elseif($SettingsData['home_page'] == 'video_background')
<script src="{{asset('frontend/js/jarallax.min.js')}}"></script>
<script src="{{asset('frontend/js/jarallax-video.min.js')}}"></script>
@elseif($SettingsData['home_page'] == 'water_fade_background')
<script src="{{asset('frontend/js/jquery.ripples-min.js')}}"></script>
@endif
<script src="{{asset('frontend/js/animatedModal.min.js')}}"></script>
<script src="{{asset('frontend/js/simplebar.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.barfiller.js')}}"></script>
<script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/js/lity.min.js')}}"></script>
<script src="{{asset('frontend/js/parsley.min.js')}}"></script>
@if($SettingsData['recaptcha'] == 1)
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
@endif
@stack('scripts')
<script src="{{asset('frontend/js/main.js')}}"></script>

<script type="text/javascript">
	let cookieModal = document.querySelector(".cookie_consent_card");
	let acceptCookieBtn = document.querySelector(".accept_btn");

	acceptCookieBtn.addEventListener("click", function (){
		cookieModal.classList.remove("active");
		localStorage.setItem("cookie_consent", 1);
	});

	let cookieAccepted = localStorage.getItem("cookie_consent");
	if (cookieAccepted == 1){
		cookieModal.classList.remove("active");
	}else{
		cookieModal.classList.add("active");
	}
</script>

</body>
</html>