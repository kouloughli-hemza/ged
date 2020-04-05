<div id="searchFilters" class="off-canvas off-canvas-right   off-canvas-push off-canvas-overlay">
    <div class="off-canvas-header">
        <a href="#" class="df-logo">@lang('Search') <span>@lang('Advanced')</span></a>
        <a href="#" class="close"><i data-feather="x"></i></a>
    </div>
    <div class="off-canvas-body pd-25 tx-13">



        {{-- Filter By Arrival Direction --}}
        @if(Auth::user()->hasRole('Admin'))
        <div class="form-group col-md-12">
            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">
                @lang('Filter by direction')
            </label>
            {!! Form::select('direction', $directions, Request::has('direction') && Request::get('direction') ? Request::get('direction') : '',
                ['class' => 'form-control select2', 'id' => 'Filterdirections','form' => 'search-form']) !!}

        </div>
        @endif
        {{-- Filter By Direction --}}


        {{-- Filter By Arrival Date --}}
        <div class="form-group col-md-12">

            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Filter by arrival date')</label>
            <input type="text" form="search-form" id="filterArrivee" class="form-control" name="filter_date_arrivee"
                   placeholder="@lang('Select arrival date')" autocomplete="off"
            >
        </div>
        {{-- Filter By Arrival Date --}}


        <button type="submit" form="search-form" class="btn btn-primary btn-block">@lang('Filter result')</button>


    </div>
</div>
@push('custom-scripts')
    <script>
        $('.select2').select2({
            placeholder: 'Choose one',
            searchInputPlaceholder: 'Search options'
        });
    </script>
@endpush


