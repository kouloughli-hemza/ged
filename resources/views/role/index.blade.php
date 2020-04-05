@extends('layouts.app')

@section('page-title', __('Roles'))
@section('page-heading', __('Roles'))

@section('breadcrumbs')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>

                    <li class="breadcrumb-item active" aria-current="page"> @lang('Roles')</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

    @include('partials.messages')

    <div class="card mg-b-10">
        <div class="card-body pd-y-30">
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-right">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('Add Role')
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-dashboard mg-b-0">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('Name')</th>
                        <th class="min-width-150">@lang('Display Name')</th>
                        <th class="min-width-150">@lang('# of users with this role')</th>
                        <th class="text-center">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (count($roles))
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->role_name }}</td>
                                    <td>{{ $role->role_display }}</td>
                                    <td>{{ $role->users_count }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-icon"
                                           title="@lang('Edit Role')" data-toggle="tooltip" data-placement="top">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($role->removable)
                                            <a href="{{ route('roles.destroy', $role) }}" class="btn btn-icon"
                                               title="@lang('Delete Role')"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="@lang('Please Confirm')"
                                               data-confirm-text="@lang('Are you sure that you want to delete this role?')"
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
@stop
