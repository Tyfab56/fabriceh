@extends('layouts.frontend')

@php
$SettingsData = gSettings();
@endphp

@section('title', $SettingsData['site_title'] ? __('Home').' - '.$SettingsData['site_title'] : __('Home').' - Personal Portfolio Laravel')

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
                <div class="avatar">
                    <img src="{{ $your_photo ? asset('media/'.$your_photo) : asset('frontend/images/avatar.jpg') }}" alt="image" />
                </div>
                <h1>{{ $name }}</h1>
                <h3>{{ $subtitle }}</h3>
                TEST
                @if($btntext != '')
                <a href="/another" class="btn black-btn margin-rb mt-3">{{ $btntext }}</a>
                @endif
                <h2 class="ah-headline clip">

                    <span class="ah-words-wrapper">
                        @foreach ($animated_clip_text as $key => $row)
                        @if($key == 0)
                        <b class="is-visible">{{ $row->post_title }}</b>
                        @else
                        <b>{{ $row->post_title }}</b>
                        @endif
                        @endforeach
                    </span>
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="bottom-copyright d-none d-lg-block">
    <p>{{ $SettingsData['copyright'] }}</p>
</div>
<div class="social-icons-area d-none d-lg-block">
    <ul class="social-icons">
        @foreach ($SettingsData['social_media'] as $key => $row)
        @if($row != '')
        <li><a href="{{ $row }}"><i class="fa fa-{{ $key }}"></i></a></li>
        @endif
        @endforeach
    </ul>
</div>
</section><!--/Home Section/-->
<!--About Section-->
<section class="section none-block display-none" id="about" data-simplebar>
    <div class="tp-btn-close close-about">
        <i class="fa fa-times"></i>
    </div>
    <div class="container">
        <div class="page-title text-center">
            <p class="subtitle">{{ __('About') }}</p>
            <h1 class="title">{{ __('My Resume') }}</h1>
        </div>
        <div class="section-inner">
            <!--About Info-->
            <div class="row">
                <div class="col-12 col-md-5 col-lg-5">
                    <div class="info-image">
                        <img src="{{ $aboutdata->your_photo ? asset('media/'.$aboutdata->your_photo) : asset('frontend/images/about-me.jpg') }}" alt="image" />
                    </div>
                </div>
                <div class="col-12 col-md-7 col-lg-7">
                    <div class="info-content">
                        @if($about_title != '')
                        <h2>{{ $about_title }}</h2>
                        @endif
                        @if($aboutdata->description != '')
                        <div class="entry">
                            <p>{{ $aboutdata->description }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="row single-info">
                        @if($aboutdata->name != '')
                        <div class="col-12 col-md-12 col-lg-6">
                            <p><span>{{ __('Name') }}:</span>{{ $aboutdata->name }}</p>
                        </div>
                        @endif
                        @if($aboutdata->email != '')
                        <div class="col-12 col-md-12 col-lg-6">
                            <p><span>{{ __('Email') }}:</span><a href="mailto:{{ $aboutdata->email }}">{{ $aboutdata->email }}</a></p>
                        </div>
                        @endif
                        @if($aboutdata->skype != '')
                        <div class="col-12 col-md-12 col-lg-6">
                            <p><span>{{ __('Skype') }}:</span>{{ $aboutdata->skype }}</p>
                        </div>
                        @endif
                        @if($aboutdata->phone != '')
                        <div class="col-12 col-md-12 col-lg-6">
                            <p><span>{{ __('Phone') }}:</span>{{ $aboutdata->phone }}</p>
                        </div>
                        @endif
                        @if($aboutdata->experience != '')
                        <div class="col-12 col-md-12 col-lg-6">
                            <p><span>{{ __('Experience') }}:</span>{{ $aboutdata->experience }}</p>
                        </div>
                        @endif
                        @if($aboutdata->address != '')
                        <div class="col-12 col-md-12 col-lg-6">
                            <p><span>{{ __('Address') }}:</span>{{ $aboutdata->address }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="row single-info-btn">
                        <div class="col-12 col-md-12">
                            @if($aboutdata->download_cv != '')
                            <a href="{{ asset('media/'.$aboutdata->download_cv) }}" class="btn black-btn margin-rb">{{ __('Download CV') }}</a>
                            @endif
                            @if($aboutdata->hire_me != '')
                            <a href="{{ $aboutdata->hire_me }}" class="btn black-btn margin-rb">{{ __('Hire Me') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!--/About Info/-->
            <!--Resume Block-->
            <div class="row resume-block">
                <!--Education-->
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="resume-items">
                        <h2 class="col-title">{{ __('Education') }}</h2>
                        @foreach ($educationdata as $key => $row)
                        @php
                        $rowdata = json_decode($row->post_content);
                        @endphp
                        <div class="item">
                            <span class="bullet"></span>
                            <div class="item-card">
                                <span><i class="fa fa-calendar"></i>{{ $rowdata->year }}</span>
                                <h3>{{ $row->post_title }}</h3>
                                <p>{{ $rowdata->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div><!--/Education/-->
                <!--Experience-->
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="resume-items">
                        <h2 class="col-title">{{ __('Experience') }}</h2>
                        @foreach ($experiencedata as $key => $row)
                        @php
                        $rowdata = json_decode($row->post_content);
                        @endphp
                        <div class="item">
                            <span class="bullet"></span>
                            <div class="item-card">
                                <span><i class="fa fa-calendar"></i>{{ $rowdata->year }}</span>
                                <h3>{{ $row->post_title }}</h3>
                                <p>{{ $rowdata->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div><!--/Experience/-->
            </div><!--/Resume Block/-->
            <!--Skills Block-->
            <div class="skills-block">
                <h2 class="col-title">{{ __('My Skills') }}</h2>
                <div class="row">
                    @foreach ($skillsdata as $key => $row)
                    @php
                    $rowdata = json_decode($row->post_content);
                    @endphp
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="progress-bar-linear">
                            <p class="progress-bar-text">{{ $row->post_title }}</p>
                            <div class="barfiller {{ $rowdata->alias }}">
                                <div class="tipWrap">
                                    <span class="tip"></span>
                                </div>
                                <span class="fill" data-percentage="{{ $rowdata->percentage }}"></span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div><!--/Skills Block/-->
        </div>
    </div>
</section><!--/About Section/-->
<!--Portfolio Section-->
<section class="section none-block display-none" id="portfolio" data-simplebar>
    <div class="tp-btn-close close-portfolio">
        <i class="fa fa-times"></i>
    </div>
    <div class="container">
        <div class="page-title text-center">
            <p class="subtitle">{{ __('Portfolio') }}</p>
            <h1 class="title">{{ __('My Works') }}</h1>
        </div>
        <div id="tp_portfolio" class="section-inner">
            <div class="row no-gutters grid-items">
                @foreach ($portfolio as $row)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 grid-item">
                    <div class="item-box">
                        <div class="item-img">
                            <img src="{{ asset('media/'.$row->image) }}" alt="image" />
                        </div>
                        @if($row->url == '')
                        <div class="item-info">
                            <a href="{{ asset('media/'.$row->image) }}" data-lity><span class="fa fa-picture-o"></span></a>
                            <h3>{{ $row->title }}</h3>
                        </div>
                        @else
                        <div class="item-info">
                            <a href="{{ $row->url }}"><span class="fa fa-link"></span></a>
                            <a href="{{ asset('media/'.$row->image) }}" data-lity><span class="fa fa-picture-o"></span></a>
                            <h3><a href="{{ $row->url }}">{{ $row->title }}</a></h3>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section><!--/Portfolio Section/-->
<!--Blog Section-->
<section class="section none-block display-none" id="blog" data-simplebar>
    <div class="tp-btn-close close-blog">
        <i class="fa fa-times"></i>
    </div>
    <div class="container">
        <div class="page-title text-center">
            <p class="subtitle">{{ __('Blog') }}</p>
            <h1 class="title">{{ __('My Articles') }}</h1>
        </div>
        <!--Blog List-->
        <div id="tp_blog" class="section-inner">
            <div class="row no-gutters grid-blogs">
                @foreach ($blog as $row)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 grid-blog">
                    <div class="blog-post blog-overlay">
                        <div class="thumbnail">
                            <img src="{{ asset('media/'.$row->image) }}" alt="image" />
                        </div>
                        <div class="blog-content">
                            <h2 class="blog-title">
                                <a href="{{ route('frontend.article', [$row->id, str_slug($row->title)]) }}">{{ $row->title }}</a>
                            </h2>
                            <div class="blog-meta">
                                <span><i class="fa fa-clock-o"></i>{{ date('d M , yy', strtotime($row->created_at)) }} </span>
                                <span><i class="fa fa-user"></i>{{ $row->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div><!--/Blog list/-->
        <div class="more-posts">
            <a href="{{ route('frontend.blog') }}" class="btn black-btn">More Posts</a>
        </div>
    </div>
</section><!--/Blog Section/-->
<!--Contact Section-->
<section class="section none-block display-none" id="contact" data-simplebar>
    <div class="tp-btn-close close-contact">
        <i class="fa fa-times"></i>
    </div>
    <div class="container">
        <div class="page-title text-center">
            <p class="subtitle">{{ __('Say Hello') }}</p>
            <h1 class="title">{{ __('Contact Me') }}</h1>
        </div>
        <div class="section-inner">
            <div class="row">
                <!--Contact Form-->
                <div class="col-12 col-md-7 col-lg-7">
                    <div class="contact-form">
                        <h2 class="col-title">{{ __('Contact Form') }}</h2>
                        <div id="sent_message"></div>
                        <form id="contact-form" novalidate="" data-validate="parsley">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control parsley-validated" data-required="true" placeholder="{{ __('Name') }}*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control parsley-validated" data-required="true" placeholder="{{ __('Email Address') }}*">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" id="subject" class="form-control parsley-validated" data-required="true" placeholder="{{ __('Subject') }}*">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" class="form-control parsley-validated" data-required="true" placeholder="{{ __('Message') }}*"></textarea>
                                    </div>
                                </div>
                            </div>
                            @if($SettingsData['recaptcha'] == 1)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ $SettingsData['sitekey'] }}"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <input type="text" name="isreCaptcha" id="isreCaptcha" class="display-none" value="{{ $SettingsData['recaptcha'] }}">
                            <!--route-->
                            <input id="sentContactFormMessageId" type="text" class="display-none" value="{{ route('frontend.sentContactFormMessage') }}" />
                            <a href="javascript:void(0);" class="btn black-btn submit-form-class">{{ __('Send Message') }}</a>
                        </form>
                    </div>
                </div><!--/Contact Form/-->
                <!--Contact Info-->
                <div class="col-12 col-md-5 col-lg-5">
                    <div class="contact-info">
                        <h2 class="col-title">{{ __('Contact Info') }}</h2>
                        @if($contact_title != '')
                        <p>{{ $contact_title }}</p>
                        @endif
                        <div class="row">
                            @if($contactdata->email != '')
                            <div class="col-12">
                                <div class="info">
                                    <span class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <div class="desc">
                                        <span>{{ __('Email') }}</span>
                                        <p><a href="mailto:{{ $contactdata->email }}">{{ $contactdata->email }}</a></p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($contactdata->skype != '')
                            <div class="col-12">
                                <div class="info">
                                    <span class="icon">
                                        <i class="fa fa-skype"></i>
                                    </span>
                                    <div class="desc">
                                        <span>{{ __('Skype') }}</span>
                                        <p>{{ $contactdata->skype }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($contactdata->phone != '')
                            <div class="col-12">
                                <div class="info">
                                    <span class="icon">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <div class="desc">
                                        <span>{{ __('Phone') }}</span>
                                        <p>{{ $contactdata->phone }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($contactdata->address != '')
                            <div class="col-12">
                                <div class="info">
                                    <span class="icon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <div class="desc">
                                        <span>{{ __('Address') }}</span>
                                        <p>{{ $contactdata->address }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div><!--/Contact Info/-->
            </div>
        </div>
    </div>
    @if($SettingsData['is_gmap'] == 1)
    <!--Google Map-->
    <div class="google_map" id="google_map"></div>
    <!--/Google Map/-->
    @endif
</section><!--/Contact Section/-->
@endsection

@push('scripts')
@if($SettingsData['is_gmap'] == 1)
<script type="text/javascript">
    function initMap() {
        var latlng = {
            lat: <?php echo $SettingsData['gmap']->Latitude; ?>,
            lng: <?php echo $SettingsData["gmap"]->Longitude; ?>
        };
        var map = new google.maps.Map(document.getElementById('google_map'), {
            zoom: <?php echo $SettingsData['gmap']->zoom; ?>,
            center: latlng,
            zoomControl: true,
            scaleControl: false,
            scrollwheel: false,
            disableDoubleClickZoom: true
        });
        var contentString = '<div class="map-tooltip">' +
            '<ul class="map-tooltip-content">' +
            @if($contactdata - > email != '')
        '<li><h2>{{ __("Email") }}</h2><p>{{ $contactdata->email }}</p></li>' +
        @endif
        @if($contactdata - > skype != '')
        '<li><h2>{{ __("Skype") }}</h2><p>{{ $contactdata->skype }}</p></li>' +
        @endif
        @if($contactdata - > phone != '')
        '<li><h2>{{ __("Phone") }}</h2><p>{{ $contactdata->phone }}</p></li>' +
        @endif
        @if($contactdata - > address != '')
        '<li><h2>{{ __("Address") }}</h2><p>{{ $contactdata->address }}</p></li>' +
        @endif
            '</ul>' +
            '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        var marker = new google.maps.Marker({
            position: latlng,
            map: map
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $SettingsData['gmap']->api_key; ?>&callback=initMap"></script>
@endif
<script type="text/javascript">
    var skill_barColor = "{{$SettingsData['color']->fill_color}}";
    var animatedColor = "{{$SettingsData['color']->theme_background_color}}";
    var home_page = "{{$SettingsData['home_page']}}";
    var isreCaptcha = "{{$SettingsData['recaptcha']}}";
    var skillsdata = <?php echo $skillsdata; ?>;
</script>
@endpush