<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
            <meta charset="utf-8">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
            <meta name="description" content="Vitrine web du photographe Fabrice H">
            <meta name="author" content="">
            <meta name="keywords" content="art,photo,voyage,photographe,">
            <meta name="robots" content="all">
            <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

        <title>Fabrice H Photographer</title>

        <!-- Fonts -->
      
        <link rel="stylesheet" href="{{asset('css/style.css') }}">
  
    </head>
    <body>


    <div class="container">
			<div class="row">
				
                <div class="hfg-slot center">
                    <div class="builder-item desktop-left"><div class="item--inner builder-item--logo" >
                        <div class="site-logo">
                            <a class="brand" href="{{route('home') }}" title="Fabrice H Photographer" aria-label="Fabrice H Photographer">
                                <img width="200" height="49" src="{{ asset('assets/images/logo.png') }}" class="neve-site-logo skip-lazy" alt="" decoding="async" loading="lazy" data-variant="logo" srcset="" sizes="(max-width: 200px) 100vw, 200px">
                            </a>
                        </div>

	                 </div>
                </div>
            </div>
            <div class="row">
           
				
				
				
				
				<a href="#">
                    <span class="et_pb_image_wrap ">
                        <img  width="1600" height="533" src="{{ asset('assets/images/DSC0389-Panorama_uxga.jpg') }}" >
                     </span>    
                </a>
                    
            </div>
	</div>
		
    </body>
</html>
