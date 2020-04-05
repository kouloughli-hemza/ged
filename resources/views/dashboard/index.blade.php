@extends('layouts.app')

@section('page-title', __('Dashboard'))
@section('page-heading', __('Dashboard'))

@section('breadcrumbs')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="#">@lang('Dashboard')</a></li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">@lang('Welcome')</h4>
        </div>
    </div>
@stop

@section('content')
    @include('partials.messages')

    <div class="row row-xs">

        @foreach (\Kouloughli\Plugins\Kouloughli::availableWidgets(auth()->user()) as $widget)
               {!! app()->call([$widget, 'render']) !!}
        @endforeach

    </div>

@stop


@section('scripts')
    @foreach (\Kouloughli\Plugins\Kouloughli::availableWidgets(auth()->user()) as $widget)
        @if (method_exists($widget, 'scripts'))
            {!! app()->call([$widget, 'scripts']) !!}
        @endif
    @endforeach

@stop