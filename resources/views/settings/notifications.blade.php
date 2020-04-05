@extends('layouts.app')

@section('page-title', __('Notification Settings'))
@section('page-heading', __('Notification Settings'))

@section('breadcrumbs')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item"><a href="#">@lang('Settings')</a></li>

                    <li class="breadcrumb-item active" aria-current="page">@lang('Notifications')</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <h5 class="card-header">
                @lang('Email Notifications')
            </h5>

            <div class="card-body">
                {!! Form::open(['route' => 'settings.notifications.update', 'id' => 'notification-settings-form']) !!}

                    <div class="form-group mb-4">
                        <div class="d-flex align-items-center">
                            <div class="custom-control custom-switch">
                                <input type="hidden" value="0" name="notifications_signup_email">

                                <input type="checkbox"
                                       name="notifications_signup_email"
                                       class="custom-control-input"
                                       value="1"
                                       id="switch-signup-email"
                                       {{ setting('notifications_signup_email') ? 'checked' : '' }}>

                                <label for="switch-signup-email" class="custom-control-label"></label>
                            </div>
                            <div class="ml-3 d-flex flex-column">
                                <label class="mb-0">@lang('Sign-Up Notification')</label>

                                <small class="pt-0 text-muted">
                                    @lang('Send an email to the Administrators when user signs up.')
                                </small>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        @lang('Update')
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@stop
