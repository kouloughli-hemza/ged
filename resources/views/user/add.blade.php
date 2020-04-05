@extends('layouts.app')

@section('page-title', __('Add User'))
@section('page-heading', __('Create New User'))

@section('breadcrumbs')

    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">@lang('Users')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('Create')</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'users.store', 'files' => true, 'id' => 'user-form']) !!}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('User Details')
                    </h5>
                    <p class="text-muted font-weight-light">
                        @lang('A general user profile information.')
                    </p>
                </div>
                <div class="col-md-9">
                    @include('user.partials.details', ['edit' => false, 'profile' => false])
                </div>
            </div>
        </div>
    </div>

    <div class="divider-text">@lang('Login Details')</div>


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Login Details')
                    </h5>
                    <p class="text-muted font-weight-light">
                        @lang('Details used for authenticating with the application.')
                    </p>
                </div>
                <div class="col-md-9">
                    @include('user.partials.auth', ['edit' => false])
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="plus"></i>
                        @lang('Create User')
                    </button>
                </div>
            </div>
        </div>
    </div>


{!! Form::close() !!}

<br>
@stop

@section('scripts')
    {!! HTML::script('assets/js/as/profile.js') !!}
    {!! JsValidator::formRequest('Kouloughli\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@stop