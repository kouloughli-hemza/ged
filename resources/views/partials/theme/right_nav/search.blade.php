<div class="navbar-search">
    <div class="navbar-search-header">
        {!! Form::open(['route' => 'files.index', 'method'=> 'GET','files' => false, 'id' => 'search-form','style'=>'width:100%']) !!}
        <input type="search"
               name="search"
               class="form-control find-document"
               style="width:95%"
               placeholder="@lang('Type to start searching Documents')">

        <button class="btn"><i data-feather="search"></i></button>
        <a id="navbarSearchClose" href="" class="link-03 mg-l-5 mg-lg-l-10"><i data-feather="x"></i></a>
        {!! Form::close() !!}

    </div>{{-- navbar-search-header --}}
    <div class="navbar-search-body">
        <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Recherche RECENET</label>
        <ul class="list-unstyled">
            <li><a href="dashboard-one.html">Fichier wilaya</a></li>
        </ul>

        <hr class="mg-y-30 bd-0">

        <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Recherche suggerer</label>

        <ul class="list-unstyled">
            <li><a href="dashboard-one.html">Fichier GED</a></li>
        </ul>
    </div>{{-- navbar-search-body --}}
</div>{{-- navbar-search --}}