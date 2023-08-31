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
						<div class="avatar">ddd</div>
						<h2>"BWR" stands for "Black, White and Red," which are the primary tones in Fabrice H's compositions in the "Another World" series.</h2>
					<img src="{{ asset('frontend/images/bwr.jpg') }}" alt="bwr" />
					<p> The artist's intention is to capture attention by reducing the color palette and concentrating it in shades of red-orange, thereby enhancing the strong lines of the image and playing with the contrast generated by desaturating certain areas. </br>This approach redirects the natural attention the viewer would have given to the original image.
The process may appear visually intense, yet it deepens the immersion in the image, consequently engaging the viewer. The artist, in a way, compels the brain to make a decision about the emotion to evoke. It might be loved or disliked, but indifference is seldom the response.
The resulting works often bear a striking resemblance to the landscapes of the planet Mars, evoking an otherworldly and alien aesthetic that sparks the imagination. There might be a few other colors, such as greens or oranges, remaining in a marginal way. However, it's vital to emphasize that this photographic work doesn't aspire to be a painting.
The initial series presented was captured in Iceland, a land of contrasts whose terrain suits this visual experiment exceptionally well. The series comprises 66 pieces, for a personal reason known to the artist.
The BWR Series benefits from a distinctive delivery method for 1/1 prints; they are personally handed over by the author, regardless of the destination. The artist values meeting collectors and observing the environment in which the artwork will reside.</p>


					</div>
				</div>
			</div>
</div>	
</section>

@endsection