<div class="card bd-t-0 mg-b-10">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover documents-table">
                <thead>
                <tr>
                    <th></th>
                    <th class="tx-12">@lang('Object')</th>
                    <th class="tx-12">@lang('Arrival date')</th>
                    @if(Auth::user()->hasRole('Admin'))
                    <th class="tx-12">@lang('Direction')</th>
                    @else
                    <th class="tx-12">@lang('user')</th>
                    @endif
                    <th class="tx-12">@lang('Importance')</th>
                    <th class="tx-12">@lang('Size')</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @include('file-manager.list.partials.rows')
                </tbody>
            </table>
        </div>
    </div>
</div>