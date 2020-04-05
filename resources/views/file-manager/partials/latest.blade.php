<label class="d-block tx-medium tx-10 tx-uppercase tx-sans tx-spacing-1 tx-color-03 mg-b-15">@lang('Recently added documents')</label>
<div class="row row-xs">
    @if (count($latests))

        @foreach ($latests as $latest)
        <div class="col-6 col-sm-4 col-md-3 ">
            <div class="card card-file">
                <div class="dropdown-file">
                    <a href="" class="dropdown-link" data-toggle="dropdown"><i data-feather="more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">

                        {{-- Start Preview Part --}}
                        <a href="#modalViewDetails"
                           data-toggle="modal"
                           class="dropdown-item details"
                           data-expiditeur="{{$latest->expiditeur}}"
                           data-destinataire="{{$latest->destinataire}}"
                           data-objet="{{$latest->objet}}"
                           data-nombre_page="{{$latest->nombre_page}}"
                           data-communication_a="{{$latest->communication_a}}"
                           data-date_arrivee="{{$latest->date_arrivee->format(config('app.date_format'))}}"
                           data-date_arrivee_human="{{$latest->date_arrivee->diffForHumans()}}"

                           data-direction="{{$latest->user->direction->direc_name}}"
                           data-created_at="{{$latest->created_at->format(config('app.date_format'))}}"
                           data-created_at_humans="{{$latest->created_at->diffForHumans()}}"
                        >
                            <i data-feather="info"></i>@lang('View details')
                        </a>
                        {{-- End Preview Part --}}


                        {{-- Start Preview Part --}}
                        <a href="#previewDocument"
                           data-path="{{ $latest->file_path }}"
                           data-toggle="modal"
                           class="dropdown-item details"
                        >
                            <i data-feather="eye"></i>@lang('Preview')
                        </a>
                        {{-- End Preview Part --}}


                        {{-- Start Editing Part --}}
                        <a href="{{ route('files.edit',$latest->id) }}"
                           class="dropdown-item details"
                        >
                            <i data-feather="edit-3"></i>@lang('Edit')
                        </a>
                        {{-- End Editing Part --}}


                        {{--<a href="" class="dropdown-item important"><i data-feather="star"></i>Mark as Important</a>
                        <a href="" class="dropdown-item download"><i data-feather="download"></i>Download</a>
                        <a href="#" class="dropdown-item rename"><i data-feather="edit"></i>Rename</a>--}}
                    </div>
                </div>{{-- dropdown --}}
                <div class="card-file-thumb tx-danger">
                    <i class="far fa-file-pdf"></i>
                </div>
                <div class="card-body">
                    <h6>
                        <a href="#previewDocument"
                           data-path="{{ $latest->file_path }}"
                           data-toggle="modal" class="link-02">
                            {{$latest->objet}}
                        </a>
                    </h6>

                    <span>{{$latest->file_size}}</span>
                </div>
                <div class="card-footer"><span class="d-none d-sm-inline">@lang('Arrival date'): </span>{{ $latest->date_arrivee->format(config('app.date_format')) }}</div>
            </div>
        </div>{{-- col --}}
        @endforeach

    @else
        <tr>
            <td colspan="7"><em>@lang('No records found.')</em></td>
        </tr>
    @endif

</div>{{-- row --}}