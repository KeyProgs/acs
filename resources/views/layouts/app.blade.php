<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="identifier-url" content="http://acsassurance.com"/>
    <meta name="author" content="Acs Assurance - ............"/>
    <meta name="location" content="FRANCE"/>
    <meta name="distribution" content="web">
    <meta name="designer" content="Acs Assurance - .........."/>
    <meta name="publisher" content="Acs Assurance - ........."/>
    <meta name="copyright" content="Copyright © 2019 Acs Assurance - ........."/>
    <meta name="format-detection" content="telephone=yes"/>
    <meta name="HandheldFriendly" content="true"/>
    <meta name="robots" content="follow,index,all"/>

    <meta name="description" content="Acs assurance est une ........."/>
    <link rel="canonical" href="http://acsassurance.com" />
    <meta name="Keywords" content="Acs assurance : keyword 1,keyword 2 "/>
    <title>
        @if(!empty($titre))
            {{$titre}}
        @else
          Acs Assurance -
        @endif
    </title>
    <!-- master stylesheet -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!--Color Switcher Mockup-->
    <link rel="stylesheet" href="{{asset('css/color-switcher-design.css')}}">
    <!--Color Themes-->
    <link rel="stylesheet" href="{{asset('css/color-themes/default-theme.css')}}" id="theme-color-file">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('images/favicon/favicon-32x32.png')}}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{asset('images/favicon/favicon-16x16.png')}}" sizes="16x16">

    <!-- Optional SmartWizard theme
    <link href="css/smart-wizard-step/smart_wizard.css" rel="stylesheet" type="text/css"/>
    <link href="css/smart-wizard-step/smart_wizard_theme_circles.css" rel="stylesheet" type="text/css"/>
    <link href="css/smart-wizard-step/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css"/>
    <link href="css/smart-wizard-step/smart_wizard_theme_dots.css" rel="stylesheet" type="text/css"/>
    -->
    <!-- main jQuery -->
    <script src="{{asset('js/jquery.js')}}"></script>
    <!-- Wow Script -->
    <script src="{{asset('js/wow.min.js')}}"></script>
    <!-- bootstrap -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- bx slider -->
    <script src="{{asset('js/jquery.bxslider.min.js')}}"></script>
    <!-- count to -->
    <script src="{{asset('js/jquery.countTo.js')}}"></script>
    <script src="{{asset('js/jquery.appear.js')}}"></script>
    <!-- owl carousel -->
    <script src="{{asset('js/owl.js')}}"></script>
    <!-- validate -->
    <script src="{{asset('js/validation.js')}}"></script>
    <!-- mixit up -->
    <script src="{{asset('js/jquery.mixitup.min.js')}}"></script>
    <!-- isotope script-->
    <script src="{{asset('js/isotope.js')}}"></script>
    <!-- Easing -->
    <script src="{{asset('js/jquery.easing.min.js')}}"></script>
    <!-- Gmap helper -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHzPSV2jshbjI8fqnC_C4L08ffnj5EN3A"></script>
    <!--Gmap script-->
    <script src="{{asset('js/gmaps.js')}}"></script>
    <script src="{{asset('js/map-helper.js')}}"></script>
    <!-- jQuery ui js -->
    <script src="{{asset('assets/jquery-ui-1.11.4/jquery-ui.js')}}"></script>
    <!-- Language Switche  -->
    <script src="{{asset('assets/language-switcher/jquery.polyglot.language.switcher.js')}}"></script>
    <!-- jQuery timepicker js -->
    <script src="{{asset('assets/timepicker/timePicker.js')}}"></script>
    <!-- Bootstrap select picker js -->
    <script src="{{asset('assets/bootstrap-sl-1.12.1/bootstrap-select.js')}}"></script>
    <!-- html5lightbox js -->
    <script src="{{asset('assets/html5lightbox/html5lightbox.js')}}"></script>
    <!--Color Switcher-->
    <script src="{{asset('js/color-settings.js')}}"></script>

    <!--Revolution Slider-->
    <script src="{{asset('plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
    <script src="{{asset('plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{asset('plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
    <script src="{{asset('plugins/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
    <script src="{{asset('plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
    <script src="{{asset('plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
    <script src="{{asset('plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
    <script src="{{asset('plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
    <script src="{{asset('plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
    <script src="{{asset('plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
    <script src="{{asset('plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
    <script src="{{asset('js/main-slider-script.js')}}"></script>


    <script type="text/javascript" src="{{asset('assets/smart-wizard-step/jquery.smartWizard.min.js')}}"></script>
    <!-- thm custom script -->
    <script src="{{asset('js/custom.js')}}"></script>


    <!-- Fixing Internet Explorer-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <![endif]-->

</head>

<body>
@php

if (\Illuminate\Support\Facades\Session::has('user')){
   echo (\Illuminate\Support\Facades\Session::get('user')->type);
}
@endphp
<div class="boxed_wrapper">
    <!--<div class="preloader"></div>-->
    @include('includes.navbar.top-bar')
    @include('includes.navbar.header')
    @include('includes.navbar.main-navbar')

    @yield('content')

    @include('includes.footer.footer-area')
    @include('includes.footer.footer-bottom-area')
</div>

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target thm-bg-clr" data-target="html"><span class="fa fa-angle-double-up"></span>
</div>
@csrf
@include('includes.color-switcher')

</body>

</html>