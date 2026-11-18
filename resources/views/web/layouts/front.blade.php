<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="{{getAppName()}}">

    <meta name="keywords" content="Self Care"/>

    <meta name="description" content="Self Care"/>
    <meta name="author" content="selfcare.easybzi.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="turbo-cache-control" content="no-cache">
    <title>@yield('title') | {{ getAppName() }}</title>
    @php
        $hospitalSettingValue = getSettingValue();
    @endphp
    <link rel="icon" href="{{ asset($hospitalSettingValue['favicon']['value']) }}" type="image/png">

    <!-- Links of CSS files -->
    {{--    <link rel="stylesheet" href="{{ mix('web_front/css/hospital-custom.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ mix('web_front/css/hospital-home.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ mix('web_front/css/hospital-layout.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-doctors.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-about.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-contact.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-appointment.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-working-hours.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-testimonials.css') }}">--}}

    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/aos.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/meanmenu.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/remixicon.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/odometer.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/fancybox.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/selectize.min.css') }}">--}}
{{--    <link href="{{ mix('assets/css/selectize-input.css') }}" rel="stylesheet" type="text/css"/>--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/style.scss') }}">--}}
    {{--    <link rel="stylesheet" href="{{ mix('assets/css/custom.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/style.css') }}">--}}


<!-- Links of JS files -->

    {{--<script src="{{ asset('web_front/js/odometer.min.js') }}"></script>--}}
    {{--<script src="{{ asset('web_front/js/fancybox.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/selectize.min.js') }}"></script>--}}
    {{--<script src="{{ asset('web_front/js/TweenMax.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/aos.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/form-validator.min.js') }}"></script>--}}
    {{--<script src="{{ asset('assets/js/custom/helpers.js') }}"></script>--}}
    {{--<script src="{{ asset('web_front/js/contact-form-script.js') }}"></script>--}}
    {{--<script src="{{ asset('web_front/js/wow.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/main.js') }}"></script>--}}

    <link rel="stylesheet" href="{{ asset('css/selfcare-brand.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magicui-public.css') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    @yield('page_css')
    @yield('css')
    @if(isset($userName) && getSettingForReCaptcha($userName)  )
    @endif

    <script>
        $(document).ready(function () {
            $('.alert').delay(5000).slideUp(300)
        })
        $(document).on('click', '.languageSelection', function () {
            let languageName = $(this).data('prefix-value')

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'POST',
                url: '/change-language',
                data: { languageName: languageName },
                success: function () {
                    location.reload()
                },
            })
        })
    </script>
        let frontLanguage = "{{ checkLanguageSession() }}";
        Lang.setLocale(frontLanguage);
    </script>
    @yield('page_scripts')
    @yield('scripts')
</head>
<body class="magicui-site">
{{--@include('web.layouts.web_loader')--}}
@include('web.layouts.header')
@yield('content')
@include('web.layouts.footer')

<!-- Start Go Top Area -->
{{--<div class="go-top">--}}
{{--    <i class="ri-arrow-up-s-line"></i>--}}
{{--</div>--}}
<div class="go-top bg-success d-flex align-items-center justify-content-center">
    <i class="fas fa-chevron-up next-arrow"></i>
    {{Form::hidden('userCurrentLanguage',checkLanguageSession(),['class'=>'userCurrentLanguage'])}}
</div>
<!-- End Go Top Area -->
<script src="{{ asset('js/lucide-icons.js') }}"></script>
</body>
</html>
