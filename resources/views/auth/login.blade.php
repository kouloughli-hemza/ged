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



                    @if (setting('remember_me'))
                    <div class="form-group mb-4">
                        <div class="d-flex align-items-center">
                            <div class="custom-control custom-switch login-custom-switch">
                                <input type="hidden" value="0" name="remember_me">
                                {{--<input type="checkbox" class="custom-control-input" name="remember" id="remember" value="1"/>--}}
                                {!! Form::checkbox('remember', 1,'',
                                ['class' => 'custom-control-input', 'id' => 'switch-remember-me']) !!}
                                <label for="switch-remember-me" class="custom-control-label"></label>
                            </div>
                            <div class="ml-3 d-flex flex-column">
                                <label class="mb-0" for="switch-remember-me" onselectstart="return false">@lang('Remember me?')</label>
                            </div>
                        </div>
                    </div>
                    @endif

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

@section('styles')
  <style>
      .login-custom-switch{
          padding-top: 0.3rem;
          padding-left: 1rem;
          padding-right: 0.3rem;
      }
  </style>
@stop
@section('scripts')
    {!! HTML::script('assets/js/as/login.js') !!}
    {!! JsValidator::formRequest('Kouloughli\Http\Requests\Auth\LoginRequest', '#login-form') !!}
@stop
