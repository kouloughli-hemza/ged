<!DOCTYPE html>
<html lang="fr">
<head>

    {{-- Required meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- Meta --}}
    <meta name="description" content="Ged Wilaya De Mila">
    <meta name="author" content="Kouloughli">

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') - {{ setting('app_name') }}</title>

    {{-- vendor css --}}
    <link href="{{ asset(mix('assets/css/vendor.css')) }}" rel="stylesheet">


    {{-- Kouloughli CSS --}}
    @if(session()->has('darkMode'))
    <link rel="stylesheet" href="{{ asset('theme/assets/css/skin.dark.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('theme/assets/css/custom.css') }}">

    @yield('styles')
    @stack('custom-styles')
    @hook('app:styles')
</head>

<body class="app-filemgr">

{{-- DashBoard Header --}}
@include('partials.theme.header')
{{-- End Dashboard Header --}}



{{-- Start The Main Dashboard Section --}}
<div class="filemgr-wrapper" style="min-height: calc(100vh - 45px);">
        @yield('content')
</div>
{{-- End The Main Dashboard Section --}}


@yield('modals')

{{-- DashBoard Footer --}}
@include('partials.theme.footer')
{{-- End Dashboard Footer --}}


{{-- Start Scripts Section --}}
{{-- Start Scripts Section --}}
<script src="{{ asset(mix('assets/js/mix/vendors.js')) }}"></script>

<script src="{{ asset(mix('assets/js/mix/ged.js')) }}"></script>

{!! HTML::script('assets/js/as/app.js') !!}
{{-- End Vendor Files --}}



@yield('scripts')
@stack('custom-scripts')
@hook('app:scripts')
{{-- End Scripts Section --}}
</body>