@extends('layouts.auth')

@section('page-title', trans('Login'))

@section('content')
    <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
            <div class="media-body align-items-center d-none d-lg-flex">
                <div class="mx-wd-600">
                    <img src="{{ url('theme/img/login.png') }}" class="img-fluid" alt="">
                </div>

            </div>{{-- media-body --}}
            <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">

                <form role="form" action="<?= url('login') ?>" method="POST" id="login-form" autocomplete="off"  class="wd-100p">
                    @include('partials.messages')

                    <input type="hidden" value="<?= csrf_token() ?>" name="_token">
                    @if (Request::has('to'))
                        <input type="hidden" value="{{ Input::get('to') }}" name="to">
                    @endif
                    <h3 class="tx-color-01 mg-b-5">@lang('Login')</h3>
                    <p class="tx-color-03 tx-16 mg-b-40">@lang('Please signin to continue')</p>

                    <div class="form-group">
                        <label>@lang('Email or Username')</label>
                        <input type="text"
                               name="username"
                               id="username"
                               class="form-control"
                               placeholder="@lang('Email or Username')"
                               value="{{ old('username') }}">
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-between mg-b-5">
                            <label class="mg-b-0-f">@lang('Password')</label>
                            @if (setting('forgot_password'))
                            <a tabindex="-1" href="" class="tx-13">@lang('Forgot Password')</a>
                            @endif
                        </div>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control"
                               placeholder="@lang('Password')">
                    </div>
                    <button id="btn-login" class="btn btn-brand-02 btn-block">@lang('Log In')</button>
                    <div class="divider-text">Ou</div>

                    {{-- If Wilaya Allow Registration --}}
                    @if (setting('reg_enabled'))
                    <div class="tx-13 mg-t-20 tx-center">@lang("Don't have an account?")
                        <a href="<?= url("register") ?>">
                            @lang('Sign Up')
                        </a>
                    </div>
                    @endif
                    {{-- If Wilaya Allow Registration --}}

                </form>

            </div>{{-- sign-wrapper --}}
        </div>{{-- media --}}
    </div>{{-- container --}}
@stop

@section('scripts')
    {!! HTML::script('assets/js/as/login.js') !!}
    {!! JsValidator::formRequest('Kouloughli\Http\Requests\Auth\LoginRequest', '#login-form') !!}
@stop
