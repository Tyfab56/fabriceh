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
<div class="row gy-4 justify-content-center inherited-styles-for-exported-element">
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="{{ asset('frontend/images/First_rays_Langjisor-1435-square.jpg') }}" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-1.jpg" title="Gallery 1" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-2.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-2.jpg" title="Gallery 2" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-3.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-3.jpg" title="Gallery 3" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-4.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-4.jpg" title="Gallery 4" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-5.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-5.jpg" title="Gallery 5" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-6.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-6.jpg" title="Gallery 6" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-7.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-7.jpg" title="Gallery 7" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-8.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-8.jpg" title="Gallery 8" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-9.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-9.jpg" title="Gallery 9" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-10.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-10.jpg" title="Gallery 10" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-11.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-11.jpg" title="Gallery 11" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-12.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-12.jpg" title="Gallery 12" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-13.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-13.jpg" title="Gallery 13" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-14.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-14.jpg" title="Gallery 14" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-15.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-15.jpg" title="Gallery 15" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->
  <div class="col-xl-3 col-lg-4 col-md-6">
    <div class="gallery-item h-100">
      <img src="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-16.jpg" class="img-fluid" alt="">
      <div class="gallery-links d-flex align-items-center justify-content-center">
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/assets/img/gallery/gallery-16.jpg" title="Gallery 16" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
        <a href="https://bootstrapmade.com/demo/templates/PhotoFolio/gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
      </div>
    </div>
  </div><!-- End Gallery Item -->

</div>

<style>
  *, ::after, ::before {
    box-sizing: border-box;
  }

  .inherited-styles-for-exported-element {
    color: #fafafa;
    font-family: "Open Sans", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    text-align: start;
  }

  img {
    vertical-align: middle;
  }

  a, a:hover {
    text-decoration: none;
  }

  .img-fluid {
    height: auto;
    max-width: 100%;
  }

  .row {
    display: flex;
    flex-wrap: wrap;
    margin-left: calc(-.5*1.5rem);
    margin-right: calc(-.5*1.5rem);
    margin-top: calc(-1*1.5rem);
  }

  .row>* {
    flex-shrink: 0;
    margin-top: 1.5rem;
    max-width: 100%;
    padding-left: calc(1.5rem*.5);
    padding-right: calc(1.5rem*.5);
    width: 100%;
  }

  @media (min-width: 768px) {
    .col-md-6 {
      flex: 0 0 auto;
      width: 50%;
    }
  }

  @media (min-width: 992px) {
    .col-lg-4 {
      flex: 0 0 auto;
      width: 33.3333%;
    }
  }

  @media (min-width: 1200px) {
    .col-xl-3 {
      flex: 0 0 auto;
      width: 25%;
    }
  }

  .bi::before, [class*=" bi-"]::before {
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-variant: normal;
    line-height: 1;
    text-transform: none;
    vertical-align: -.125em;
  }

  .bi-arrows-angle-expand::before {
    content: "";
  }

  .bi-link-45deg::before {
    content: "";
  }

  .gallery-item {
    border-radius: 10px;
    overflow: hidden;
    position: relative;
  }

  .gallery-links {
    background-color: rgba(0, 0, 0, .6);
    bottom: 0;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    transition: all .3s ease-in-out;
    z-index: 3;
  }

  a:not([href]):not([class]), a:not([href]):not([class]):hover {
    color: inherit;
    text-decoration: none;
  }

  .gallery-item img {
    transition: all .3s;
  }

  .gallery-links .details-link, .gallery-links .preview-link {
    color: rgba(255, 255, 255, .5);
    margin-bottom: 0;
    margin-left: 8px;
    margin-right: 8px;
    transition: all .3s;
  }

  .gallery-links .preview-link {
    font-size: 20px;
    line-height: 1.2;
  }

  .gallery-links .details-link {
    font-size: 30px;
    line-height: 0;
  }

  .gallery-item:hover img {
    transform: scale(1.1);
  }

  .gallery-links .details-link:hover, .gallery-links .preview-link:hover {
    color: #fff;
  }

  .gallery-item:hover .gallery-links {
    opacity: 1;
  }

  .gallery-item:hover .details-link, .gallery-item:hover .preview-link {
    margin-top: 0;
  }

  .d-flex {
    display: flex !important;
  }

  .h-100 {
    height: 100% !important;
  }

  .justify-content-center {
    justify-content: center !important;
  }

  .align-items-center {
    align-items: center !important;
  }

  .bi::before, [class*=" bi-"]::before {
    font-family: bootstrap-icons !important;
    font-weight: 400 !important;
  }
</style>
@endsection