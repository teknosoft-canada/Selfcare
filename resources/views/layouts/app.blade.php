<!DOCTYPE html>
{{-- <html lang="en" @if (getLoggedInUser()->language == 'ar') direction="rtl" dir="rtl" style="direction: rtl" @endif > --}}
<html lang="en">

<head>
    <meta charset="UTF-8">
    @php
        $settingValue = getSuperAdminSettingValue();
        $hospitalSettingValue = getSettingValue();
        $superAdminSettingValue = getSuperAdminSettingKeyValue('app_name');
        $username = App\Models\User::where('tenant_id', getLoggedInUser()->tenant_id)->first();
        $getCurrencySymbol = getCurrencySymbol();
    @endphp
    <title>@yield('title') | {{ getLoggedInUser()->hasRole('Super Admin') ? $superAdminSettingValue : getSettingValueByKey('app_name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="turbo-cache-control" content="no-cache">
    <link rel="icon"
        href="{{ !getLoggedInUser()->hasRole('Super Admin') ? asset($hospitalSettingValue['favicon']['value']) : asset($settingValue['favicon']['value']) }}"
        type="image/png">

    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/selfcare-brand.css') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    {{--    <link href="{{ mix('assets/css/style.css') }}" rel="stylesheet" type="text/css"/> --}}
    @if (getLoggedInUser()->theme_mode)
        <link href="{{ mix('assets/css/style.dark.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ mix('assets/css/phone-number-dark.css') }}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{ mix('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <link rel="stylesheet" href="{{ asset('css/boardui-dashboard.css') }}">

       @livewireStyles
    {{--    <script src="{{ asset('livewire/livewire.css') }}"></script> --}}
    {{--    <link href="{{ asset('backend/css/vendor.css') }}" rel="stylesheet" type="text/css"/> --}}
    @yield('page_css')

    {{--    @if (getLoggedInUser()->language == 'ar') --}}
    {{--        <link href="{{asset('assets/css/style-rtl.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    @else --}}
    {{--    @endif --}}
    @yield('css')

    {{-- <script src="{{ asset('backend/js/vendor.js') }}"></script> --}}
    <script>
        let defaultCountryCodeValue = "{{ $settingValue['default_country_code']['value'] }}"
        let UserCurrentLang = "{{ getLoggedInUser()->language }}";
    </script>
    @routes
       @livewireScripts
    {{-- <script src="{{ mix('assets/js/custom/custom.js') }}"></script> --}}
    {{-- <script src="{{ mix('assets/js/custom/helpers.js') }}"></script> --}}

    @yield('page_scripts')
    <script>
        {{-- let showNoDataMsg = "{{ __('messages.common.no_data_available') }}"; --}}
        {{-- let noMatchingRecordsFound = "{{ __('messages.common.no_matching_records_found') }}"; --}}
        {{-- let defaultImage = '{{asset('web_front/images/doctors/doctor.png')}}'; --}}
            // const defaultImageUrl = '';
            (function($) {
                $.fn.button = function(action) {
                    console.log(action);
                    if (action === 'loading' && this.data('loading-text')) {
                        this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled',
                            true)
                    }
                    if (action === 'reset' && this.data('original-text')) {
                        this.html(this.data('original-text')).prop('disabled', false)
                    }
                }
                $('#overlay-screen-lock').hide()
            }(jQuery))
        // $(document).ready(function () {
        //     $('.alert').delay(5000).slideUp(300)
        // })

        $(document).ready(function() {
            $('#language').select2({
                width: '100%',
                dropdownParent: $('#changeLanguageModal'),
            });
        })

        $(document).ready(function() {
            $('.alert').delay(5000).slideUp(300)
        })

        $('.alert').delay(5000).slideUp(300, function() {
            $('.alert').attr('style', 'display:none')
        })
    </script>
    @yield('scripts')
    {{--  <script>  --}}
    {{--    let profileUrl = "{{ url('profile') }}" --}}
    {{--    let profileUpdateUrl = "{{ url('profile-update') }}" --}}
    {{--    let changePasswordUrl = "{{ url('change-password') }}" --}}
    {{--    let loggedInUserId = "{{ getLoggedInUserId() }}" --}}
    {{--    let updateLanguageURL = "{{ url('update-language')}}" --}}
    {{--    let currentCurrency = "{{ getCurrencySymbol()}}" --}}
    {{--    let pdfDocumentImageUrl = "{{ url('assets/img/pdf.png') }}" --}}
    {{--    let docxDocumentImageUrl = "{{ url('assets/img/doc.png') }}" --}}
    {{--    let audioDocumentImageUrl = "{{ url('assets/img/audio.png') }}" --}}
    {{--    let videoDocumentImageUrl = "{{ url('assets/img/video.png') }}" --}}
    {{--    let ajaxCallIsRunning = false --}}
    {{--  </script>  --}}

    {{--  <script src="{{ mix('assets/js/user_profile/user_profile.js') }}"></script> --}}
    {{-- <script src="{{ mix('assets/js/sidebar_menu_search/sidebar_menu_search.js') }}"></script>  --}}
    <script>
        let userCurrentLanguage = "{{ getLoggedInUser()->language }}";

        Lang.setLocale(userCurrentLanguage);
    </script>

</head>
<?php
$style = 'style=';
?>

<body class="boardui-app">
    {{-- <div class="d-flex flex-column flex-root"> --}}
    {{--    <div class="page d-flex flex-row flex-column-fluid"> --}}
    @include('user_profile.edit_profile_modal')
    @include('user_profile.change_password_modal')

    <div class="d-flex flex-column flex-root vh-100">
        <div class="d-flex flex-row flex-column-fluid">
            @include('layouts.sidebar')
            <div class="wrapper d-flex flex-column flex-row-fluid">
                <div class='container-fluid d-flex align-items-stretch justify-content-between px-0'>
                    @include('layouts.header')
                </div>
                <div class='content d-flex flex-column flex-column-fluid pt-7'>
                    @yield('header_toolbar')
                    <div class='d-flex flex-wrap flex-column-fluid'>
                        @yield('content')
                    </div>
                </div>
                <div class='container-fluid'>
                    @include('layouts.footer')
                </div>
            </div>
            @include('smart-patient-cards.show_modal')
        </div>
    </div>
    {{ form::hidden('pdfDocumentImageUrl', url('assets/img/pdf.png'), ['id' => 'pdfDocumentImageUrl']) }}
    {{ form::hidden('docxDocumentImageUrl', url('assets/img/pdf.png'), ['id' => 'docxDocumentImageUrl']) }}
    {{ Form::hidden('ajaxCallIsRunning', false, ['class' => 'ajaxCallIsRunning']) }}
    {{ Form::hidden('loggedInUserId', getLoggedInUserId(), ['class' => 'loggedInUserId']) }}
    {{ Form::hidden('profileUrl', url('profile'), ['class' => 'profileUrl']) }}
    {{ Form::hidden('profileUpdateUrl', url('profile-update'), ['class' => 'profileUpdateUrl']) }}
    {{ Form::hidden('changePasswordUrl', url('change-password'), ['class' => 'changePasswordUrl']) }}
    {{ Form::hidden('updateLanguageURL', url('update-language'), ['class' => 'updateLanguageURL']) }}
    {{ Form::hidden('userCurrentLanguage', getLoggedInUser()->language, ['class' => 'userCurrentLanguage']) }}
    {{ Form::hidden('superAdminCurrentCurrency', superAdminCurrency(), ['class' => 'superAdminCurrentCurrency']) }}
    {{ Form::hidden('currentCurrency', $getCurrencySymbol, ['class' => 'currentCurrency']) }}
    {{ Form::hidden('pdfDocumentImageUrl', url('assets/img/pdf.png'), ['class' => 'pdfDocumentImageUrl']) }}
    {{ Form::hidden('docxDocumentImageUrl', url('assets/img/doc.png'), ['class' => 'docxDocumentImageUrl']) }}
    {{ Form::hidden('audioDocumentImageUrl', url('assets/img/audio.png'), ['class' => 'audioDocumentImageUrl']) }}
    {{ Form::hidden('videoDocumentImageUrl', url('assets/img/video.png'), ['class' => 'videoDocumentImageUrl']) }}
    {{ Form::hidden('deleteVariable', __('messages.common.delete'), ['class' => 'deleteVariable']) }}
    {{ Form::hidden('yesVariable', __('messages.common.yes'), ['class' => 'yesVariable']) }}
    {{ Form::hidden('noVariable', __('messages.common.no'), ['class' => 'noVariable']) }}
    {{ Form::hidden('cancelVariable', __('messages.common.cancel'), ['class' => 'cancelVariable']) }}
    {{ Form::hidden('confirmVariable', __('messages.common.are_you_sure_want_to_delete_this'), ['class' => 'confirmVariable']) }}
    {{ Form::hidden('deletedVariable', __('messages.common.deleted'), ['class' => 'deletedVariable']) }}
    {{ Form::hidden('hasBeenDeletedVariable', __('messages.common.has_been_deleted'), ['class' => 'hasBeenDeletedVariable']) }}
    {{ Form::hidden('okVariable', __('messages.common.ok'), ['class' => 'okVariable']) }}

    <script src="{{ asset('js/lucide-icons.js') }}"></script>

</body>

</html>
