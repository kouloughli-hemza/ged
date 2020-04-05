@foreach($documents as $document)
    <tr>
        <td class="tx-color-03 tx-normal">
            <div class="card-file-thumb tx-danger custom-file-thumb">
                <i class="far fa-file-pdf"></i>
            </div>
        </td>
        <td class="tx-12 document-object"><span>{{ $document->objet }}</span></td>
        <td class="tx-color-03 tx-12 tx-normal">{{$document->date_arrivee->format(config('app.date_format'))}}</td>
        @if(Auth::user()->hasRole('Admin'))
        <td class="tx-color-03 tx-12 tx-normal">{{$document->user->direction->direc_name}}</td>
        @else
        <td class="tx-normal tx-12">{{ $document->user->first_name . ' ' .  $document->user->last_name}}</td>
        @endif
        <td class="tx-medium tx-12 align-middle ">
            <span class="badge  badge-{{ $document->present()->labelClass }}">
            {{ trans("app.importance.{$document->importance}") }}
        </span>
        </td>
        <td class="tx-medium tx-12 ">
            {{$document->file_size}}
        </td>
        <td>
            <nav style="visibility: hidden;">
                @include('file-manager.partials.actions')
            </nav>
        </td>

    </tr>
@endforeach()

@push('custom-scripts')
    <script>
        feather.replace({width: '1.2em', height: '1.2em'})
    </script>
@endpush