@extends('layouts.auth')

@section('page-title', __('404'))


@section('content')

    <div class="container ht-100p tx-center">
        <div class="ht-100p d-flex flex-column align-items-center justify-content-center">
            <div class="wd-70p wd-sm-250 wd-lg-300 mg-b-15">
                <img src="{{ url('theme/img/404.png') }}" class="img-fluid" alt="">
            </div>
            <h1 class="tx-color-01 tx-24 tx-sm-32 tx-lg-36 mg-xl-b-5">404 @lang('Page Not Found')</h1>
            <h5 class="tx-16 tx-sm-18 tx-lg-20 tx-normal mg-b-20">@lang('Sorry, the page you are looking for could not be found.')</h5>
            <p class="tx-color-03 mg-b-30">@lang('You may have mistyped the address or the page may have moved')</p>
            <div class="d-flex mg-b-40">
                <a href="{{ url('/') }}" class="btn btn-brand-02 bd-0 mg-l-5 pd-sm-x-25"><i data-feather="arrow-left"></i>  @lang('Go Home')</a>
            </div>

        </div>
    </div>{{-- container --}}

@stop