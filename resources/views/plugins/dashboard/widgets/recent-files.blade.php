<div class="col-lg-12 col-xl-8 mg-t-10">
    <div class="card mg-b-10">
        <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
            <div>
                <h6 class="mg-b-5">@lang('Recent uploaded Files')</h6>
                <p class="tx-13 tx-color-03 mg-b-0">@lang('List of recent uploaded files to Mila GED')</p>
            </div>

        </div>{{-- card-header --}}
        <div class="card-body pd-y-30">
            <div class="d-sm-flex">
                <div class="media">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                        <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">@lang('This Week')</h6>
                        <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">{{ $thisWeek }}</h4>
                    </div>
                </div>
                <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-5">
                        <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">@lang('This Month')</h6>
                        <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">{{ $thisMonth }}</h4>
                    </div>
                </div>
                <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                        <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">@lang('This Year')</h6>
                        <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">{{ $thisYear }}</h4>
                    </div>
                </div>
            </div>
        </div>{{-- card-body --}}
        @if (count($latestFiles))
        <div class="table-responsive">
            <table class="table table-dashboard mg-b-0">
                <thead>
                <tr>
                    <th>@lang('File')</th>
                    <th>@lang('Arrival date')</th>
                    <th>@lang('Direction')</th>
                    <th>@lang('user')</th>
                    <th>@lang('Size')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($latestFiles as $file)
                <tr>
                    <td class="tx-color-03 tx-normal">{{ $file->file_name }}</td>
                    <td class="tx-color-03 tx-normal">{{$file->date_arrivee->format(config('app.date_format'))}}</td>
                    <td class="tx-color-03 tx-normal">{{$file->user->direction->direc_name}}</td>
                    <td class="tx-normal">{{ $file->user->first_name . ' ' .  $file->user->last_name}}</td>
                    <td class="tx-medium ">
                        {{$file->file_size}}
                    </td>
                </tr>
                @endforeach()
                </tbody>
            </table>
        </div>{{-- table-responsive --}}
        @endif
    </div>{{-- card --}}

</div>{{-- col --}}
