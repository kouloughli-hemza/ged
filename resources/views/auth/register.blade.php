@extends('layouts.auth')

@section('page-title', trans('Sign Up'))

@section('content')

<div class="container">
    <div class="media align-items-stretch justify-content-center ht-100p">
        <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
            <div class="pd-t-20 wd-100p">
                @include('partials/messages')

                <h4 class="tx-color-01 mg-b-5">@lang('Register')</h4>
                <p class="tx-color-03 tx-16 mg-b-40">@lang('Make sure to enter all details correctly')</p>
                <form role="form" action="<?= url('register') ?>" method="post" id="registration-form" autocomplete="off" class="mt-3">
                    <input type="hidden" value="<?= csrf_token() ?>" name="_token">

                    {{-- Start Direction Details --}}
                    @include('auth.registrationSteps.wizard')

                </form>
                <div class="divider-text">Ou</div>
                <div class="tx-13 mg-t-20 tx-center">@lang('Already have an account?') <a href="<?= url("login") ?>">@lang('Login')</a></div>
            </div>
        </div>{{-- sign-wrapper --}}



        <div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
            <div class="mx-lg-wd-500 mx-xl-wd-550">
                <img src="{{ url('theme/img/register2.svg') }}" class="img-fluid" alt="Inscription GED MILA">
            </div>
        </div>



    </div>{{-- media --}}
</div>{{-- container --}}
@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('theme/assets/css/registration/registration.css') }}">
@stop
@section('scripts')
    <script src="{{ asset('theme/lib/jquery-steps/build/jquery.steps.js') }}"></script>
    {!! HTML::script('assets/js/as/btn.js') !!}
    <script>
    var registerText = "@lang('Register')";
    </script>
    <script src="{{ asset('theme/assets/js/registration/registration.js') }}"></script>

    {!! JsValidator::formRequest('Kouloughli\Http\Requests\Auth\RegisterRequest', '#registration-form') !!}
@stop