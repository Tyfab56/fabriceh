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
<div class="container h-100 newsroom">
			<div class="row h-100 align-items-center justify-content-center">
				<div class="col-12 col-lg-12 text-center">
					<div class="home-content">
					<div class="container">
							<div class="row">
								<!-- Box 1 -->
								<div class="col-md-3">
								<a href="{{ route('frontend.newsroom', ['id' => 'C']) }}" class="card-link">
									<div class="card">
										<img src="{{ asset('frontend/images/communique.png') }}" class="card-img-top img-fluid mx-auto pt-2" style="max-width: 100px;" alt="Image 1">
										<div class="card-body">
											<p class="card-text">{{ __('NewsCommunique') }}</p>
										</div>
									</div>
									</a>
								</div>

								<!-- Box 2 -->
								<div class="col-md-3">
								<a href="{{ route('frontend.newsroom', ['id' => 'M']) }}" class="card-link">
									<div class="card">
										<img src="{{ asset('frontend/images/medias.png') }}" class="card-img-top img-fluid mx-auto pt-2" style="max-width: 100px;" alt="Image 2">
										<div class="card-body">
											<p class="card-text">{{ __('NewsMedias') }}</p>
										</div>
									</div>
								</a>
								</div>

								<!-- Box 3 -->
								<div class="col-md-3">
									<div class="card">
										<img src="{{ asset('frontend/images/articles.png') }}" class="card-img-top img-fluid mx-auto pt-2" style="max-width: 100px;" alt="Image 3">
										<div class="card-body">
											<p class="card-text">{{ __('NewsArticle') }}</p>
										</div>
									</div>
								</div>

								<!-- Box 4 -->
								<div class="col-md-3">
									<div class="card">
										<img src="{{ asset('frontend/images/contact.png') }}" class="card-img-top img-fluid mx-auto pt-2" style="max-width: 100px;"  alt="Image 4">
										<div class="card-body">
											<p class="card-text">{{ __('NewsContact') }}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						@if ($id === "C")




						<div class="card news-communique">
                            <div class="card-body">
                                <h4 class="card-title">Products For Approval</h4>
                                <h5 class="card-subtitle">Here is the list of products waiting for approval</h5>
                                <div class="product d-flex align-items-center p-t-20 p-b-20 border-bottom">
                                    <img class="product-image m-r-20" alt="" src="../assets/images/product/2.png">
                                    <div class="product-detail">
                                        <h5 class="font-bold">Apple iphone6 plus</h5>
                                        <span class="font-15 text-muted">Submitted for approval on 5 April 2017</span>
                                        <h4 class="font-20 font-bold text-info m-t-30">$699.99</h4>
                                    </div>
                                    <div class="product-action ml-auto m-b-5 align-self-end">
                                        <button class="btn btn-success">Approve</button>
                                        <button class="btn btn-outline-secondary">Decline</button>
                                    </div>
                                </div>
                                <div class="product d-flex align-items-center p-t-20 p-b-20 border-bottom">
                                    <img class="product-image m-r-20" alt="" src="../assets/images/product/2.png">
                                    <div class="product-detail">
                                        <h5 class="font-bold">New! Apple-iwatch Nike+ 42mm space gray</h5>
                                        <span class="font-15 text-muted">Approved on 1 April 2017</span>
                                        <h4 class="font-20 font-bold text-info m-t-30">$250.00</h4>
                                    </div>
                                    <div class="product-action ml-auto m-b-5 align-self-end">
                                        <button class="btn btn-outline-secondary"><i class="mdi mdi-check text-success m-r-10 font-14"></i>Approved</button>
                                    </div>
                                </div>
                                <div class="product d-flex align-items-center p-t-20">
                                    <img class="product-image m-r-20" alt="" src="../assets/images/product/1.png">
                                    <div class="product-detail">
                                        <h4 class="font-bold">New! Apple-ipad silver black 128gb</h4>
                                        <span class="font-15 text-muted">Declined on 1 April 2017</span>
                                        <h4 class="font-20 font-bold text-info m-t-30">$329.78</h4>
                                    </div>
                                    <div class="product-action ml-auto m-b-5 align-self-end">
                                        <button class="btn btn-outline-secondary"><i class="mdi mdi-close text-danger m-r-10 font-14"></i>Declined</button>
                                    </div>
                                </div>
                            </div>
                        </div>



					
						@foreach ($pressReleases as $pressRelease)
							<div class="press-release">
								<h2>{{ $pressRelease->title }}</h2>
								<p>{{ $pressRelease->description }}</p>
								<p>Langue : {{ $pressRelease->language }}</p>
								<a href="{{ asset($pressRelease->pdf_path) }}" target="_blank">Télécharger le PDF</a>
							</div>
  
							
						@endforeach
					@else
						
						<p>La valeur de $id n'est pas "C".</p>
					@endif

					</div>
				</div>
			</div>
</div>	
</section>

@endsection
@push('scripts')
<script type="text/javascript">
var skill_barColor = "{{$SettingsData['color']->fill_color}}";
var animatedColor = "{{$SettingsData['color']->theme_background_color}}";
var home_page = "{{$SettingsData['home_page']}}";
var skillsdata = '';
</script>
@endpush