{{-- Start Preview Part --}}
<a href="#modalViewDetails"
   data-toggle="modal"
   class="{{  !Session::has('list-view') ? 'dropdown-item details' : '' }}"
   data-expiditeur="{{$document->expiditeur}}"
   data-destinataire="{{$document->destinataire}}"
   data-objet="{{$document->objet}}"
   data-nombre_page="{{$document->nombre_page}}"
   data-communication_a="{{$document->communication_a}}"
   data-date_arrivee="{{$document->date_arrivee->format(config('app.date_format'))}}"
   data-date_arrivee_human="{{$document->date_arrivee->diffForHumans()}}"

   data-direction="{{$document->user->direction->direc_name}}"
   data-created_at="{{$document->created_at->format(config('app.date_format'))}}"
   data-created_at_humans="{{$document->created_at->diffForHumans()}}"
>
    <i data-feather="info"></i><span>@lang('View details')</span>
</a>
{{-- End Preview Part --}}


{{-- Start Preview Part --}}
<a href="#previewDocument"
   data-path="{{ $document->file_path }}"
   data-toggle="modal"
   class="{{  !Session::has('list-view') ? 'dropdown-item details' : '' }}"
>
    <i data-feather="eye"></i><span>@lang('Preview')</span>
</a>
{{-- End Preview Part --}}


{{-- Start Editing Part --}}
<a href="{{ route('files.edit',$document->id) }}"
   class="{{  !Session::has('list-view') ? 'dropdown-item details' : '' }}"
>
    <i data-feather="edit-3"></i><span>@lang('Edit')</span>
</a>
{{-- End Editing Part --}}