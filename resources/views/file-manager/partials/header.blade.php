<div class="filemgr-content-header">
    <i data-feather="search"></i>
    {!! Form::open(['route' => 'files.index', 'method'=> 'GET','files' => false, 'id' => 'search-form','class' => 'search-form']) !!}
        <input  type="search"
               name="search"
               value="{{ Request::get('search') }}"
               autocomplete="off"
               class="form-control find-document"
               placeholder="@lang('Type to start searching Documents')">
    <input type="text" name="importance" value="{{ Request::get('importance') }}" id="importance-filter" style="position: absolute; left: -9999px">

    <input type="text" name="order_by" value="{{ Request::get('order_by') }}" id="orderBy" style="position: absolute; left: -9999px">

    <input type="submit" id="submit-search" style="position: absolute; left: -9999px">

    {!! Form::close() !!}

    <nav class="nav d-none d-sm-flex mg-l-auto">
        <a href="{{ route('list.view') }}" class="nav-link"><i data-feather="{{ Session::has('list-view') ? 'grid' : 'list' }}"></i></a>
        <a href="#searchFilters" class="nav-link search-filter"><i data-feather="filter"></i></a>
    </nav>
</div>{{-- filemgr-content-header --}}

