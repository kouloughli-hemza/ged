<div class="col-lg-6 col-xl-6 mg-t-10">
    <div class="card">
        <div class="card-header pd-t-20 pd-b-0 bd-b-0">
            <h6 class="mg-b-5">@lang('Documents by direction')</h6>
            <p class="tx-12 tx-color-03 mg-b-0">@lang('The number of documents uploaded by direction')</p>
        </div>{{-- card-header --}}
        <div class="card-body pd-20">
            <div class="chart-two mg-b-20">
                <div id="documentsByDirection" class="flot-chart"></div>
            </div>{{-- chart-two --}}
            <div class="row">
                <div class="col-sm">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">@php echo array_values(array_slice($counts, -1))[0] @endphp</h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-semibold mg-b-10 tx-primary">@php echo array_keys(array_slice($counts, -1))[0] @endphp</p>
                    <div class="tx-12 tx-color-03">@lang('Direction with highest documents count')</div>
                </div>{{-- col --}}
                <div class="col-sm mg-t-20 mg-sm-t-0">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">@php echo reset($counts) @endphp</h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-semibold mg-b-10 tx-pink">@php echo key($counts) @endphp</p>
                    <div class="tx-12 tx-color-03">@lang('Direction with low documents upload')</div>
                </div>{{-- col --}}
            </div>{{-- row --}}
        </div>{{-- card-body --}}
    </div>{{-- card --}}
</div>