@extends('layouts.app')

@section('page-title', __('Permissions'))
@section('page-heading', __('Permissions'))

@section ('breadcrumbs')

    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> @lang('Permissions')</li>
                </ol>
            </nav>
        </div>
    </div>

@stop

@section('content')

@include('partials.messages')

{!! Form::open(['route' => 'permissions.save', 'class' => 'mb-4']) !!}

<div class="card mg-b-10">
    <div class="card-body pd-y-30">

        <div class="row mb-3 pb-3 border-bottom-light">
            <div class="col-lg-12">
                <div class="float-right">
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-rounded">
                        <i class="fas fa-plus mr-2"></i>
                        @lang('Add Permission')
                    </a>
                </div>
            </div>
        </div>

        <div class="table-responsive" id="users-table-wrapper">
            <table class="table table-dashboard mg-b-0">
                <thead>
                    <tr>
                        <th class="min-width-200">@lang('Name')</th>
                        @foreach ($roles as $role)
                            <th class="text-center">{{ $role->role_name }}</th>
                        @endforeach
                        <th class="text-center min-width-100">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($permissions))
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->perm_display ?: $permission->perm_name }}</td>

                            @foreach ($roles as $role)
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        {!!
                                            Form::checkbox(
                                                "roles[{$role->ref_role}][]",
                                                $permission->ref_perm,
                                                $role->hasPermission($permission->perm_name),
                                                [
                                                    'class' => 'custom-control-input',
                                                    'id' => "cb-{$role->ref_role}-{$permission->ref_perm}"
                                                ]
                                            )
                                        !!}
                                        <label class="custom-control-label d-inline"
                                               for="cb-{{ $role->ref_role }}-{{ $permission->ref_perm }}"></label>
                                    </div>
                                </td>
                            @endforeach

                            <td class="text-center">
                                <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-icon"
                                   title="@lang('Edit Permission')" data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-edit"></i>
                                </a>

                                @if ($permission->removable)
                                    <a href="{{ route('permissions.destroy', $permission) }}" class="btn btn-icon"
                                       title="@lang('Delete Permission')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('Please Confirm')"
                                       data-confirm-text="@lang('Are you sure that you want to delete this permission?')"
                                       data-confirm-delete="@lang('Yes, delete it!')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4"><em>@lang('No records found.')</em></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@if (count($permissions))
    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary btn-block">@lang('Save Permissions')</button>
        </div>
    </div>
@endif

{!! Form::close() !!}

@stop
