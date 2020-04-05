@extends('layouts.app')

@section('page-title', $user->present()->nameOrEmail . ' - ' . __('Active Sessions'))

@section('page-heading')
    @lang('Sessions') ({{ $user->present()->nameOrEmail }})
@stop

@section('breadcrumbs')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                     @if (isset($adminView))
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.show', $user->id) }}">
                                {{ $user->present()->nameOrEmail }}
                            </a>
                        </li>
                     @endif
                    <li class="breadcrumb-item active" aria-current="page"> @lang('Sessions')</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

@include('partials.messages')

<div class="card mg-b-10">
    <div class="card-body pd-y-30">
        <div class="table-responsive">
            <table class="table table-dashboard mg-b-0">
                <thead>
                    <tr>
                        <th>@lang('IP Address')</th>
                        <th>@lang('Device')</th>
                        <th>@lang('Browser')</th>
                        <th>@lang('Last Activity')</th>
                        <th class="text-center">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($sessions))
                        @foreach ($sessions as $session)
                            <tr>
                                <td>{{ $session->ip_address }}</td>
                                <td>
                                    {{ $session->device ?: __('Unknown') }} ({{ $session->platform ?: __('Unknown') }})
                                </td>
                                <td>{{ $session->browser ?: __('Unknown') }}</td>
                                <td>{{ $session->last_activity->format(config('app.date_time_format')) }}</td>
                                <td class="text-center">
                                    <a href="{{ isset($profile) ? route('profile.sessions.invalidate', $session->id) : route('user.sessions.invalidate', [$user->ref_user, $session->id]) }}"
                                       class="btn btn-icon"
                                       title="@lang('Invalidate Session')"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       data-method="DELETE"
                                       data-confirm-title="@lang('Please Confirm')"
                                       data-confirm-text="@lang('Are you sure that you want to invalidate this session?')"
                                       data-confirm-delete="@lang('Yes, proceed!')">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6"><em>@lang('No records found.')</em></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop
