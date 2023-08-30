@extends('layouts.frontend')

@php
$SettingsData = gSettings();
@endphp

@foreach ($blog as $row)
@section('title', __('Blog').' - '.$row->title)
@section('meta-content')
	<meta name="keywords" content="{{ $row->seo_keywords }}" />
	<meta name="description" content="{{ $row->seo_desc }}" />
	<meta property="og:title" content="{{ $row->title }}" />
	<meta property="og:site_name" content="{{ $SettingsData['metatag']->site_name }}" />
	<meta property="og:description" content="{{ $row->seo_desc }}" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="{{ url()->current() }}" />
	<meta property="og:image" content="{{ asset('media/'.$row->image) }}" />
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
	<meta name="twitter:url" content="{{ url()->current() }}">
	<meta name="twitter:title" content="{{ $row->title }}">
	<meta name="twitter:description" content="{{ $row->seo_desc }}">
	<meta name="twitter:image" content="{{ asset('media/'.$row->image) }}">
@endsection
@endforeach

@section('content')
	<!--Blog Section-->
	<section class="section">
		<div class="container">
			<div class="page-title text-center">
				<p class="subtitle"><a href="{{ url('/') }}">{{ __('Home') }}</a></p>
				<h1 class="title"><a href="{{ route('frontend.blog') }}">{{ __('My Articles') }}</a></h1>
			</div>
			<!--Blog List-->
			<div class="section-inner">
				<div class="row">
					<!--blog-->
					@foreach ($blog as $row)
					<div class="col-md-8 offset-md-2">
						<div class="blog-post blog-overlay">
							<div class="thumbnail">
								<img src="{{ asset('media/'.$row->image) }}" alt="image" />
							</div>
						</div>
						<div class="single-blog entry">
							<h2 class="blog-title">{{ $row->title }}</h2>
							<div class="blog-meta">
								<span><i class="fa fa-clock-o"></i>{{ date('d M , yy', strtotime($row->created_at)) }}</span>
								<span><i class="fa fa-user"></i>{{ $row->name }}</span>
							</div>
							{!! $row->description !!}
						</div>
					</div>
					@endforeach
					<!--/blog/-->
				</div>
				<!--Recent Posts-->
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<div class="recent-post-heading">{{ __('Recent Posts') }}</div>
						<div class="row no-gutters grid-blogs">
							@foreach ($recent_posts as $row)
							<div class="col-12 col-sm-6 col-md-6 col-lg-6 grid-blog">
								<div class="blog-post blog-overlay">
									<div class="thumbnail">
										<img src="{{ asset('media/'.$row->image) }}" alt="image" />
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
					</div>
				</div><!--/Recent Posts/-->
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
