@extends('layouts.user-app')

@section('page-title', __('Document Management'))
@section('page-heading', __('Document Management'))


@section('content')
    <div class="filemgr-wrapper">
        {{-- SideBar--}}
        @include('file-manager.partials.sidebar')
        {{-- End SideBar--}}

        <div class="filemgr-content">
            {{-- Start  Header section--}}
            @include('file-manager.partials.header')
            {{-- End Header Section--}}

            {{-- Start  Main Content section--}}
            @includeUnless($edit,'file-manager.partials.content')
            {{-- End Main Content Section--}}

            {{-- Start  Edit section--}}
            @includeWhen($edit,'file-manager.partials.edit-document')
            {{-- End Edit Section--}}
        </div>
    </div>
@stop

@section('modals')
    @if(!$edit)
        {{-- Start Details Modal --}}
        @include('file-manager.partials.modals.scanner-modal')
        {{-- End Details Modal --}}

        {{-- Start Details Modal --}}
        @include('file-manager.partials.modals.file-details')
        {{-- End Details Modal --}}

        {{-- Start File form Modal --}}
        @include('file-manager.partials.modals.file-form')
        {{-- End File Form Modal --}}


        {{-- Start Preview Document  Modal --}}
        @include('file-manager.partials.modals.preview')
        {{-- End Preview Document  Modal --}}


        {{-- Start Search Filters Off canvas --}}
        @include('file-manager.partials.search-filters')
        {{-- End Search Filters Off canvas --}}
        <div id="result"></div>
    @endif
@stop


@section('file-manager-menu')
    <a href="" id="mainMenuOpen" class="burger-menu d-none"><i data-feather="menu"></i></a>'
    <a href="" id="filemgrMenu" class="burger-menu d-lg-none"><i data-feather="arrow-left"></i></a>
@stop

@section('styles')
    <style>
        .wd-15p {
            width: {{ $space['spacePercentage'] }}%;
        }
        .filemgr-content-header .search-form {
            width: 65%;
        }
        .select2-container--open {
            z-index: 9999999;
        }
        div#scannerUploader h3 {
            display: none;
        }
    </style>
@stop

@section('scripts')
    <script src="{{ asset('theme/lib/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script type="text/javascript">
        var currentClientIp = "{{ $currentClientIp }}",
            filesScannerRoute = "{{ Route('files.scanner') }}",
            emptySearchImage = "{{url('theme/img/no-search-results-icon-retina.svg')}}",
            noResutFound = "@lang('No Result found')",
            route = "{{ route('autocomplete') }}",
            prefetchRoute = "{{ route('prefetch') }}",
            redirectAfterUpload = "{{ route('files.index') }}",
            btnScanningText = "@lang('Scanning document...')";
    </script>
    {!! HTML::script('assets/js/as/btn.js') !!}
    <script src="{{ asset(mix('assets/js/mix/documents.js')) }}"></script>
@stop