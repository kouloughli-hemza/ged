@if (count($documents))
<label class="d-block tx-medium tx-10 tx-uppercase tx-sans tx-spacing-1 tx-color-03 mg-b-15">@lang('Documents')</label>
@endif
<div class="row row-xs">
    @if (count($documents))
    @foreach($documents as $document)
    <div class="col-6 col-sm-4 col-md-3  mg-t-10">
        <div class="card card-file">
            <div class="dropdown-file">
                <a href="" class="dropdown-link" data-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    @include('file-manager.partials.actions')
                </div>
            </div>{{-- dropdown --}}
            <div class="card-file-thumb tx-danger">
                <i class="far fa-file-pdf"></i>
            </div>
            <div class="card-body">
                <h6>
                    <a href="#previewDocument"
                       data-path="{{ $document->file_path }}"
                       data-toggle="modal" class="link-02">
                        {{$document->objet}}
                    </a>
                </h6>
                <span>{{$document->file_size}}</span>
            </div>
            <div class="card-footer"><span class="d-none d-sm-inline">@lang('Arrival date'): </span>{{ $document->date_arrivee->format(config('app.date_format')) }}</div>
        </div>
    </div>{{-- col --}}

    @endforeach
    @else
    @include('partials.search-error.no-result')
    @endif

</div>{{-- row --}}