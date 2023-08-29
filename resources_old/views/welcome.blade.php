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
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
        <style>
        /* Original: https://fonts.googleapis.com/css?family=Sintony:regular,700&#038;subset=latin,latin-ext&#038;display=swap */
        /* User Agent: Mozilla/5.0 (Unknown; Linux x86_64) AppleWebKit/538.1 (KHTML, like Gecko) Safari/538.1 Daum/4.1 */
            @font-face {
                font-family: 'Sintony';
                font-style: normal;
                font-weight: 400;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/sintony/v13/XoHm2YDqR7-98cVUET0tvw.ttf) format('truetype');
            }
            @font-face {
                font-family: 'Sintony';
                font-style: normal;
                font-weight: 700;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/sintony/v13/XoHj2YDqR7-98cVUGYgIr94Jlg.ttf) format('truetype');
            }
            /* User Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0 */
            @font-face {
                font-family: 'Sintony';font-style: normal;font-weight: 400;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/sintony/v13/XoHm2YDqR7-98cVUET0tvA.woff) format('woff');
                }
            @font-face {font-family: 'Sintony';font-style: normal;font-weight: 700;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/sintony/v13/XoHj2YDqR7-98cVUGYgIr94JlQ.woff) format('woff');
                }
                /* User Agent: Mozilla/5.0 (Windows NT 6.3; rv:39.0) Gecko/20100101 Firefox/39.0 */
            @font-face {
                font-family: 'Sintony';
                font-style: normal;
                font-weight: 400;font-display: swap;
                src: url(https://fonts.gstatic.com/s/sintony/v13/XoHm2YDqR7-98cVUET0tug.woff2) format('woff2');
                    }
            @font-face {
                font-family: 'Sintony';font-style: normal;font-weight: 700;
                font-display: swap;
                src: url(https://fonts.gstatic.com/s/sintony/v13/XoHj2YDqR7-98cVUGYgIr94Jkw.woff2) format('woff2');
            }
        </style>
    </head>
    <body>


    <div class="container">
			<div class="row">
				
                <div class="hfg-slot center">
                    <div class="builder-item desktop-left">
                        <div class="item--inner builder-item--logo" >
                            <div class="site-logo">
                                <a class="brand" href="{{route('home') }}" title="Fabrice H Photographer" aria-label="Fabrice H Photographer">
                                    <img width="200" height="49" src="{{ asset('assets/images/logo.png') }}" class="neve-site-logo skip-lazy" alt="" decoding="async" loading="lazy" data-variant="logo" srcset="" sizes="(max-width: 200px) 100vw, 200px">
                                </a>
                            </div>
                        </div>
	                 </div>
                </div>
            </div>
            <div class="row">
               <div class="text-center-container ">
                    <p><strong>Nouvelle collection : Another World Iceland</strong></p>
                </div>
                <div class="banner1-container">
                   <img  width="1600" height="533" src="{{ asset('assets/images/DSC0389-Panorama_uxga.jpg') }}" >
                </div>
				<a href="#">
                   
                </a>
                    
            </div>
	</div>
		
    </body>
</html>
