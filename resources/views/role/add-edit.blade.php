@extends('layouts.app')

@section('page-title', __('Roles'))
@section('page-heading', $edit ? $role->name : __('Create New Role'))

@section('breadcrumbs')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">@lang('Roles')</a></li>

                    <li class="breadcrumb-item active" aria-current="page"> {{ __($edit ? 'Edit' : 'Create') }}</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

@include('partials.messages')

@if ($edit)
    {!! Form::open(['route' => ['roles.update', $role], 'method' => 'PUT', 'id' => 'role-form']) !!}
@else
    {!! Form::open(['route' => 'roles.store', 'id' => 'role-form']) !!}
@endif

<div class="card mg-b-10">
    <div class="card-body pd-y-30">
        <div class="row">
            <div class="col-md-3">
                <h5 class="card-title">
                    @lang('Role Details')
                </h5>
                <p class="text-muted">
                    @lang('A general role information.')
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="name">@lang('Name')</label>
                    <input type="text"
                           class="form-control input-solid"
                           id="name"
                           name="role_name"
                           placeholder="@lang('Role Name')"
                           value="{{ $edit ? $role->role_name : old('role_name') }}">
                </div>
                <div class="form-group">
                    <label for="display_name">@lang('Display Name')</label>
                    <input type="text"
                           class="form-control input-solid"
                           id="display_name"
                           name="role_display"
                           placeholder="@lang('Display Name')"
                           value="{{ $edit ? $role->role_display : old('role_display') }}">
                </div>
                <div class="form-group">
                    <label for="description">@lang('Description')</label>
                    <textarea name="role_description"
                              id="description"
                              class="form-control input-solid">{{ $edit ? $role->role_description : old('role_description') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">
    {{ __($edit ? 'Edit Role' : 'Create Role') }}
</button>

@stop

@section('scripts')
    @if ($edit)
        {!! JsValidator::formRequest('Kouloughli\Http\Requests\Role\UpdateRoleRequest', '#role-form') !!}
    @else
        {!! JsValidator::formRequest('Kouloughli\Http\Requests\Role\CreateRoleRequest', '#role-form') !!}
    @endif
@stop
