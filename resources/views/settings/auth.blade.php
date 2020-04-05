@extends('layouts.app')

@section('page-title', __('Authentication Settings'))
@section('page-heading', __('Authentication'))

@section('breadcrumbs')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item"><a href="#">@lang('Settings')</a></li>

                    <li class="breadcrumb-item active" aria-current="page">@lang('Authentication')</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

@include('partials.messages')

{{-- Nav tabs --}}
<ul class="nav nav-pills mb-4 mt-2" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a href="#auth"
           class="nav-link active"
           id="pills-home-tab"
           data-toggle="pill"
           aria-controls="pills-home"
           aria-selected="true">
            <i class="fa fa-lock"></i>
            @lang('Authentication')
        </a>
    </li>
    <li class="nav-item">
        <a href="#registration"
           class="nav-link"
           id="pills-home-tab"
           data-toggle="pill"
           aria-controls="pills-home"
           aria-selected="true">
            <i class="fa fa-user-plus"></i>
            @lang('Registration')
        </a>
    </li>
</ul>

{{-- Tab panes --}}
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="auth">
        <div class="row">
            <div class="col-md-6">
                @include('settings.partials.auth')

            </div>
            <div class="col-md-6">
                @include('settings.partials.throttling')
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="registration">
        <div class="row">
            <div class="col-md-6">
                @include('settings.partials.registration')
            </div>
            {{--<div class="col-md-6">
                @include('settings.partials.recaptcha')
            </div>--}}
        </div>
    </div>
</div>

@stop