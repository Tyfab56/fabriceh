@extends('layouts.frontend')

@php
$SettingsData = gSettings();
@endphp

@section('title',  $SettingsData['site_title'] ? __('Home').' - '.$SettingsData['site_title'] : __('Home').' - Personal Portfolio Laravel')

@section('meta-content')
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
<div class="container h-100">
			<div class="row h-100 align-items-center justify-content-center">
				<div class="col-12 col-lg-12 text-center">
					<div class="home-content">
					<div class="container">
    <div class="row">
        <!-- Box 1 -->
        <div class="col-md-3">
            <div class="card">
                <img src="{{ asset('frontend/images/communique.png') }}" class="card-img-top" alt="Image 1">
                <div class="card-body">
                    <p class="card-text">{{ __('NewsCommunique') }}</p>
                </div>
            </div>
        </div>

        <!-- Box 2 -->
        <div class="col-md-3">
            <div class="card">
                <img src="{{ asset('frontend/images/medias.png') }}" class="card-img-top" alt="Image 2">
                <div class="card-body">
                    <p class="card-text">{{ __('NewsMedias') }}</p>
                </div>
            </div>
        </div>

        <!-- Box 3 -->
        <div class="col-md-3">
            <div class="card">
                <img src="{{ asset('frontend/images/articles.png') }}" class="card-img-top" alt="Image 3">
                <div class="card-body">
                    <p class="card-text">{{ __('NewsArticle') }}</p>
                </div>
            </div>
        </div>

        <!-- Box 4 -->
        <div class="col-md-3">
            <div class="card">
                <img src="{{ asset('frontend/images/contact.png') }}" class="card-img-top" alt="Image 4">
                <div class="card-body">
                    <p class="card-text">{{ __('NewsContact') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

					</div>
				</div>
			</div>
</div>	
</section>

@endsection
@push('scripts')
<script type="text/javascript">
var home_page = "{{$SettingsData['home_page']}}";
</script>
@endpush