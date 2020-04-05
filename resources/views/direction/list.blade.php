@extends('layouts.app')

@section('page-title', __('Directions'))
@section('page-heading', __('Directions'))

@section('breadcrumbs')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('Dashboard')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('Directions')</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

    @include('partials.messages')

    <div class="card mg-b-10">
        <div class="card-body pd-y-30">

            <form action="" method="GET" id="directions-form" class="pb-2 mb-3 border-bottom-light">
                <div class="row my-3 flex-md-row flex-column-reverse">
                    <div class="col-md-4 mt-md-0 mt-2">
                        <div class="input-group custom-search-form">
                            <input type="text"
                                   class="form-control input-solid"
                                   name="search"
                                   value="{{ Request::get('search') }}"
                                   placeholder="@lang('Search for directions...')">

                            <span class="input-group-append">
                                @if (Request::has('search') && Request::get('search') != '')
                                    <a href="{{ route('directions.index') }}"
                                       class="btn btn-light d-flex align-items-center text-muted"
                                       role="button">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                                <button class="btn btn-light" type="submit" id="search-directions-btn">
                                    <i class="fas fa-search text-muted"></i>
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-2 mt-2 mt-md-0">
                        {!!
                            Form::select(
                                'status',
                                $statuses,
                                Request::get('status'),
                                ['id' => 'status', 'class' => 'form-control input-solid']
                            )
                        !!}
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route('directions.create') }}" class="btn btn-primary float-right">
                            <i data-feather="plus"></i>
                            @lang('Add Direction')
                        </a>
                    </div>
                </div>
            </form>

            <div class="table-responsive" id="directions-table-wrapper">
                <table class="table table-dashboard mg-b-0">
                    <thead>
                    <tr>
                        <th class="min-width-80">@lang('Direction')</th>
                        <th class="min-width-150">@lang('Description')</th>
                        <th class="min-width-100">@lang('Email')</th>
                        <th class="min-width-100">@lang('Phone')</th>
                        <th class="min-width-100">@lang('Total documents')</th>
                        <th class="min-width-80">@lang('Registration Date')</th>
                        <th class="min-width-80">@lang('Status')</th>
                        <th class="text-center min-width-150">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($directions))
                        @foreach ($directions as $direction)
                            @include('direction.partials.row')
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><em>@lang('No records found.')</em></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {!! $directions->render() !!}

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#directions-form").submit();
        });
    </script>
@stop
