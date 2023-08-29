@extends('layouts.frontend')

@php
$SettingsData = gSettings();
@endphp

@section('title',  $SettingsData['site_title'] ? __('Blog').' - '.$SettingsData['site_title'] : __('Blog').' - Personal Portfolio Laravel')

@section('meta-content')
	<meta name="keywords" content="{{ $SettingsData['metatag']->keywords }}" />
	<meta name="description" content="{{ $SettingsData['metatag']->description }}" />
	<meta property="og:title" content="{{ $SettingsData['site_title'] }}" />
	<meta property="og:site_name" content="{{ $SettingsData['metatag']->site_name }}" />
	<meta property="og:description" content="{{ $SettingsData['metatag']->description }}" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ $SettingsData['metatag']->url }}" />
	<meta property="og:image" content="{{ asset('public/media/'.$SettingsData['metatag']->cover_image) }}" />
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
	<meta name="twitter:image" content="{{ asset('public/media/'.$SettingsData['metatag']->cover_image) }}">
@endsection

@section('content')
	<!--Blog Section-->
	<section class="section">
		<div class="container">
			<div class="page-title text-center">
				<p class="subtitle"><a href="{{ url('/') }}">{{ __('Home') }}</a></p>
				<h1 class="title">{{ __('My Articles') }}</h1>
			</div>
			<!--Blog List-->
			<div id="tp_blog" class="section-inner">
				<div class="row no-gutters grid-blogs">
					@foreach ($blog as $row)
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 grid-blog">
						<div class="blog-post blog-overlay">
							<div class="thumbnail">
								<img src="{{ asset('public/media/'.$row->image) }}" alt="image" />
							</div>
							<div class="blog-content">
								<h2 class="blog-title">
									<a href="{{ route('frontend.article', [$row->id, str_slug($row->title)]) }}">{{ $row->title }}</a>
								</h2>
								<div class="blog-meta">
									<span><i class="fa fa-clock-o"></i>{{ date('d M , yy', strtotime($row->created_at)) }}</span>
									<span><i class="fa fa-user"></i>{{ $row->name }}</span>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div><!--/Blog list/-->
		</div>
	</section><!--/Blog Section/-->	
@endsection

@push('scripts')
<script type="text/javascript">
var skill_barColor = "{{$SettingsData['color']->fill_color}}";
var animatedColor = "{{$SettingsData['color']->theme_background_color}}";
var home_page = "{{$SettingsData['home_page']}}";
var skillsdata = [];
</script>
@endpush
