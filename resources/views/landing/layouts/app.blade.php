<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{ getSuperAdminSettingKeyValue('app_name') }} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="google" content="notranslate">
    @php
        $settingValue = getSuperAdminSettingValue();
    @endphp
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="turbo-cache-control" content="no-cache">
    <link rel="icon" href="{{ asset($settingValue['favicon']['value']) }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/selfcare-brand.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magicui-public.css') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    {{--    <link href="{{mix('landing_front/css/custom.css')}}" rel="stylesheet" type="text/css"> --}}
    {{--    <link href="{{mix('landing_front/css/layout.css')}}" rel="stylesheet" type="text/css"> --}}
    {{--    <link href="{{ asset('landing_front/css/toast.css') }}" rel="stylesheet" type="text/css"> --}}

    {{--    <link href="{{asset('assets/landing-theme/css/line-awesome.min.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--          type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/spacing.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/base.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/shortcodes.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--        <link href="{{asset('assets/landing-theme/css/style.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/responsive.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/theme-color/color-5.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/css/landing/landing.css')}}" rel="stylesheet" type="text/css"/> --}}
    @yield('page_css')
    @yield('css')
    @routes
       @livewireScripts
       @livewireStyles
    <script>
        // $(document).ready(function(){
        //     $('.payment-type').selectize();
        // });
        if ($('.mySwiper').length) {
            var swiper = new Swiper('.mySwiper', {
                spaceBetween: 40,
                centeredSlides: false,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1.2,
                        spaceBetween: 20,
                    },
                    576: {
                        slidesPerView: 1.5,
                        spaceBetween: 20,
                    },
                    992: {
                        slidesPerView: 2.5,
                    },
                    1400: {
                        slidesPerView: 3.5,
                    },
                },
            })
        }

        setTimeout(function() {
            $('.custom-message').fadeOut()
        }, 2000)
    </script>
        let frontLanguage = "{{ checkLanguageSession() }}";
        Lang.setLocale(frontLanguage);
    </script>
</head>

<body class="magicui-site">

    {{-- <div class="page-wrapper"> --}}
    {{--    <div id="ht-preloader"> --}}
    {{--        <div class="clear-loader"> --}}
    {{--            <div class="loader"> --}}
    {{--                <div class="loader-div"><span>{{ getAppName()}}</span> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </div> --}}
    <div class="page-wrapper">

        @include('landing.layouts.header')

        @yield('content')

        @include('landing.layouts.footer')
    </div>
    {{ Form::hidden('invalidNumber', __('messages.common.invalid_number'), ['class' => 'invalidNumber']) }}
    {{ Form::hidden('invalidCountryNumber', __('messages.common.invalid_country_code'), ['class' => 'invalidCountryNumber']) }}
    {{ Form::hidden('tooShort', __('messages.common.too_short'), ['class' => 'tooShort']) }}
    {{ Form::hidden('tooLong', __('messages.common.too_long'), ['class' => 'tooLong']) }}

    {{-- <script src="{{ asset('assets/js/custom/helpers.js') }}"></script> --}}
    {{-- <script src="{{ asset('landing_front/js/toast.js') }}"></script> --}}
    {{-- <script src="{{ mix('assets/js/custom/helpers.js') }}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/common-theme.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/counter/counter.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/isotope/isotope.pkgd.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/particles.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/vivus/pathformer.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/vivus/vivus.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/raindrops/raindrops.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/contact-form/contact-form.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/wow.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/theme-script.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/js/landing/languageChange/languageChange.js') }}"></script> --}}
    {{-- <script src="{{ mix('assets/js/subscribe/create.js') }}"></script> --}}
    @yield('page_scripts')
    @yield('scripts')
    <script src="{{ asset('js/lucide-icons.js') }}"></script>
</body>

</html>


{{-- <!DOCTYPE html> --}}
{{-- <html> --}}
{{-- <head> --}}
{{--    <meta charset="UTF-8"> --}}
{{--    <title>@yield('title') | {{ getAppName()}} </title> --}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}"/> --}}
{{--    <meta name="google" content="notranslate"> --}}
{{--    @php --}}
{{--        $settingValue = getSuperAdminSettingValue(); --}}
{{--    @endphp --}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1"/> --}}
{{--    <link rel="icon" href="{{ $settingValue['favicon']['value'] }}" type="image/png"> --}}

{{--    <link href="{{asset('assets/landing-theme/css/line-awesome.min.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--          type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/spacing.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/base.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/shortcodes.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/style.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/responsive.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/theme-color/color-5.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/css/landing/landing.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    @yield('page_css') --}}
{{--    @yield('css') --}}
{{-- </head> --}}
{{-- <body> --}}

{{-- <div class="page-wrapper"> --}}
{{--    <div id="ht-preloader"> --}}
{{--        <div class="clear-loader"> --}}
{{--            <div class="loader"> --}}
{{--                <div class="loader-div"><span>{{ getAppName()}}</span> --}}
{{--                </div> --}}
{{--            </div> --}}
{{--        </div> --}}
{{--    </div> --}}
{{-- <div class="page-wrapper"> --}}
{{-- @include('landing.layouts.header') --}}

{{-- @yield('content') --}}

{{-- <div id="waterdrop"></div> --}}
{{-- @include('landing.layouts.footer') --}}
{{-- </div> --}}

{{-- @routes --}}
{{-- <script src="{{asset('assets/landing-theme/js/common-theme.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/counter/counter.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/isotope/isotope.pkgd.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/particles.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/vivus/pathformer.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/vivus/vivus.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/raindrops/raindrops.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/contact-form/contact-form.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/wow.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/theme-script.js')}}"></script> --}}
{{-- <script src="{{ asset('assets/js/landing/languageChange/languageChange.js') }}"></script> --}}
{{-- <script src="{{ mix('assets/js/subscribe/create.js') }}"></script> --}}
{{-- <script> --}}
{{--    setTimeout(function () { --}}
{{--        $('.custom-message').fadeOut(); --}}
{{--    }, 2000) --}}
{{-- </script> --}}
{{-- @yield('page_scripts') --}}
{{-- @yield('scripts') --}}
{{-- </body> --}}
{{-- </html> --}}
