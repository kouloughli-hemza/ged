@extends('layouts.app')

@section('page-title', __('General Settings'))
@section('page-heading', __('General Settings'))

@section('breadcrumbs')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item"><a href="#">@lang('Settings')</a></li>

                    <li class="breadcrumb-item active" aria-current="page">@lang('General')</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'settings.general.update', 'id' => 'general-settings-form']) !!}

<div class="row">
    <div class="col-md-8">
        <div class="card mg-b-10">
            <div class="card-body pd-y-30">
                <div class="form-group">
                    <label for="name">@lang('Name')</label>
                    <input type="text" class="form-control input-solid" id="app_name"
                           name="app_name" value="{{ setting('app_name') }}">
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">
    @lang('Update')
</button>

{{ Form::close() }}
@stop
