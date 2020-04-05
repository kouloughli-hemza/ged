@extends('layouts.app')

@section('page-title', __('Permissions'))
@section('page-heading', $edit ? $permission->name : __('Create New Permission'))

@section('breadcrumbs')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">@lang('Permissions')</a></li>

                    <li class="breadcrumb-item active" aria-current="page">{{ __($edit ? 'Edit' : 'Create') }}</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

@include('partials.messages')

@if ($edit)
    {!! Form::open(['route' => ['permissions.update', $permission], 'method' => 'PUT', 'id' => 'permission-form']) !!}
@else
    {!! Form::open(['route' => 'permissions.store', 'id' => 'permission-form']) !!}
@endif

<div class="card mg-b-10">
    <div class="card-body pd-y-30">
        <div class="row">
            <div class="col-md-3">
                <h5 class="card-title">
                    @lang('Permission Details')
                </h5>
                <p class="text-muted font-weight-light">
                    @lang('A general permission information.')
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="name">@lang('Name')</label>
                    <input type="text"
                           class="form-control input-solid"
                           id="name"
                           name="perm_name"
                           placeholder="@lang('Permission Name')"
                           value="{{ $edit ? $permission->perm_name : old('perm_name') }}">
                </div>
                <div class="form-group">
                    <label for="display_name">@lang('Display Name')</label>
                    <input type="text"
                           class="form-control input-solid"
                           id="display_name"
                           name="perm_display"
                           placeholder="@lang('Display Name')"
                           value="{{ $edit ? $permission->perm_display : old('perm_display') }}">
                </div>
                <div class="form-group">
                    <label for="description">@lang('Description')</label>
                    <textarea name="perm_description"
                              id="description"
                              class="form-control input-solid">{{ $edit ? $permission->perm_description : old('perm_description') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary">
            {{ __($edit ? "Update Permission" : "Create Permission") }}
        </button>
    </div>
</div>

@stop

@section('scripts')
    @if ($edit)
        {!! JsValidator::formRequest('Kouloughli\Http\Requests\Permission\UpdatePermissionRequest', '#permission-form') !!}
    @else
        {!! JsValidator::formRequest('Kouloughli\Http\Requests\Permission\CreatePermissionRequest', '#permission-form') !!}
    @endif
@stop
