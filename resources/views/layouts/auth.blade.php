<!DOCTYPE html>
<html lang="fr">
<head>

    {{-- Required meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- Meta --}}
    <meta name="description" content="Ged Wilaya De Mila">
    <meta name="author" content="Kouloughli Hemza">

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

    <title>@yield('page-title') - {{ setting('app_name') }}</title>

    {{-- vendor css --}}
    <link href="{{ asset('theme/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

    {{-- Kouloughli CSS --}}
    <link rel="stylesheet" href="{{ asset('theme/assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/dashforge.auth.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/skin.cool.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/skin.deepblue.css') }}">
    @yield('styles')

    @hook('app:styles')
</head>
<body>

    {{-- Start Main Auth Content --}}
    <div class="content content-fixed content-auth">

        @yield('content')

    </div>
    {{-- End Main Auth Content --}}


    {{-- Start Main Auth Footer --}}
    @include('partials.theme.footer')
    {{-- End Main Auth Footer --}}


    {{-- Start Scripts Section --}}
    <script src="{{ asset('theme/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('theme/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('theme/assets/js/dashforge.js') }}"></script>

    {!! HTML::script('assets/js/vendor.js') !!}
    {!! HTML::script('assets/js/as/app.js') !!}
    {!! HTML::script('assets/js/as/btn.js') !!}
    @yield('scripts')
    @hook('auth:scripts')
    {{-- End Scripts Sections --}}
</body>
</html>
