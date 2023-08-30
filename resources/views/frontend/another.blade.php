@extends('layouts.frontend')

section('meta-content')
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
@endsection

@section('content')
Another world
@endsection