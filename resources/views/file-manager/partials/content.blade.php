<div class="filemgr-content-body">
    @include('partials.messages')

    <div class="pd-20 pd-lg-25 pd-xl-30">
        @if(count($documents))

        @if (Request::has('search') && Request::get('search') != '')
                <h4 class="mg-b-15 mg-lg-b-25">@lang('Search result')</h4>
        @else
            @if(!Session::has('list-view'))
            <h4 class="mg-b-15 mg-lg-b-25">@lang('All documents')</h4>
            @endif
        @endif

        {{-- ================ Start Of latest Files ======== --}}
        @if (!Request::has('search') && !Request::get('search') != '' && !Session::has('list-view'))
            @include('file-manager.partials.latest')
        @endif
        @endif
        {{-- ================ End Of latest Files ======== --}}




        {{-- Start Paginating Files --}}
        <hr class="{{ Session::has('list-view') ? '' : 'mg-y-40'}} bd-0" />
        @includeUnless(Session::has('list-view'),'file-manager.partials.documents-grid')
        @includeWhen(Session::has('list-view'),'file-manager.list.list')

        {!! $documents->render()  !!}
</div>
</div>{{-- filemgr-content-body --}}