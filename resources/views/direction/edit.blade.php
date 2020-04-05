@extends('layouts.app')

@section('page-title', __('Add Direction'))
@section('page-heading', __('Create New Direction'))

@section('breadcrumbs')

    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('directions.index') }}">@lang('Directions')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('Create')</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

    @include('partials.messages')

    {!! Form::open(['route' => ['directions.update', $direction], 'method' => 'PUT', 'id' => 'direction-form']) !!}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="card-title">
                        @lang('Direction Details')
                    </h5>
                    <p class="text-muted font-weight-light">
                        @lang('A general Direction  information.')
                    </p>
                </div>
                <div class="col-md-9">
                    @include('direction.partials.details')
                </div>
            </div>
        </div>
    </div>

    @include('direction.partials.user',['create' => false])


    {!! Form::close() !!}

    <br>
@stop

@section('scripts')
    {!! HTML::script('assets/js/as/profile.js') !!}
    {!! JsValidator::formRequest('Kouloughli\Http\Requests\Direction\CreateDirectionRequest', '#direction-form') !!}
@stop