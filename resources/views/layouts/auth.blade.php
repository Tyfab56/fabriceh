@php
$SettingsData = gSettings();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
	<meta name="keywords" content="{{ $SettingsData['metatag']->keywords }}" />
	<meta name="description" content="{{ $SettingsData['metatag']->description }}" />
	<meta property="og:title" content="{{ $SettingsData['site_title'] }}" />
	<meta property="og:site_name" content="{{ $SettingsData['metatag']->site_name }}" />
	<meta property="og:description" content="{{ $SettingsData['metatag']->description }}" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ $SettingsData['metatag']->url }}" />
	<meta property="og:image" content="{{ asset('media/'.$SettingsData['metatag']->cover_image) }}" />
	<meta property="og:image:width" content="600" />
	<meta property="og:image:height" content="315" />
	@if($SettingsData['metatag']->app_id != '')
	<meta name="fb:app_id" property="fb:app_id" content="{{ $SettingsData['metatag']->app_id }}" />
	@endif
	<meta name="twitter:card" content="summary_large_image">
	@if($SettingsData['metatag']->twitter_site != '')
	<meta name="twitter:site" content="{{ $SettingsData['metatag']->twitter_site }}">
	<meta name="twitter:creator" content="{{ $SettingsData['metatag']->twitter_site }}">
	@endif
	<meta name="twitter:url" content="{{ $SettingsData['metatag']->url }}">
	<meta name="twitter:title" content="{{ $SettingsData['site_title'] }}">
	<meta name="twitter:description" content="{{ $SettingsData['metatag']->description }}">
	<meta name="twitter:image" content="{{ asset('media/'.$SettingsData['metatag']->cover_image) }}">
	<!-- favicon icon -->
	<link rel="shortcut icon" href="{{ $SettingsData['favicon'] ? asset('media/'.$SettingsData['favicon']) : asset('frontend/images/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ $SettingsData['favicon'] ? asset('media/'.$SettingsData['favicon']) : asset('frontend/images/favicon.ico') }}" type="image/x-icon">
	<!-- google fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&display=swap">
	<!-- CSS -->
	<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
	<!-- Theme color change in settings menu -->
	<style type="text/css">
	.tw-ellipsis div, .sidebar-wrapper ul.left-main-menu > li::before, .tw_radio .checkround:after, a.editIconBtn { background: {{$SettingsData['color']->backend_background_color}}; }
	.btn.green-btn:hover, .btn.green-btn.active, .my-profile-nav .dropdown-item:focus, .my-profile-nav .dropdown-item:hover, .page-item.active .page-link, .login .login-btn, .tw_checkbox input:checked ~ span, .chosen-container .chosen-results li.highlighted { background: {{$SettingsData['color']->backend_background_color}}; color: {{$SettingsData['color']->backend_text_color}}; }
	.btn.green-btn, .page-item.active .page-link, input.form-control:focus, input:focus, .custom-select:focus, .tw_checkbox input:checked ~ span, input.form-control:focus, .form-group input:focus, .form-group textarea:focus, .card .card-body input:focus, .card .card-body textarea:focus { border-color: {{$SettingsData['color']->backend_background_color}}; }
	a, a:focus, a:hover, .sidebar-wrapper ul.left-main-menu > li:hover a, .sidebar-wrapper ul.left-main-menu > li.active a, ul.tabs-nav li a.active, .login h3 a:hover, .page-link,.page-link:hover, .tw-card-header a:hover, .tw-card .tw-card-img .tw-card-overlay i.fa, .file_up_box a:hover { color: {{$SettingsData['color']->backend_background_color}}; }
	</style>
	@stack('style')
</head>
<body>

@yield('content')

<script src="{{asset('backend/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('ackend/js/popper.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
@stack('scripts')
</body>
</html>
