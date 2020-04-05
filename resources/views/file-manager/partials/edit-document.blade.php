<div class="filemgr-content-body">
@include('partials.messages')

<div class="pd-20 pd-lg-25 pd-xl-30">
    <div class="tx-medium tx-10 tx-uppercase tx-sans tx-spacing-1 tx-color-03 mg-b-15"><a href="{{ route('files.index') }}"><i data-feather="arrow-left"></i>@lang('Return to documents')</a></div>

</div>
<div class="row pd-20 pd-lg-25 pd-xl-30 pd-t-0" style="padding-top: 0px">

    <div class="col-md-7">
        {!! Form::open(['route' => ['files.update',$file->id],'method' => 'PUT', 'id' => 'file-form','files' => 'false']) !!}
        {{ csrf_field() }}
        {{-- Start Document Object --}}
        <div class="form-group">
            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"
                   data-toggle="tooltip" data-placement="top" title="@lang('Document object')"
            >@lang('Object')</label>
            <input type="text" name="objet" value="{{ $file->objet }}" class="form-control" placeholder="@lang('Document object')">
        </div>
        {{-- End Document Object --}}



        {{-- Start expiditeur & destinataire & communication_a --}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Sender')</label>
                <input type="text" name="expiditeur" value="{{ $file->expiditeur }}"  class="form-control" placeholder="@lang('Please provide the sender of the document')">
            </div>

            <div class="form-group col-md-6">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Recipient')</label>
                <input type="text" name="destinataire" value="{{ $file->destinataire }}"  class="form-control" placeholder="@lang('Please provide the receiver of the document')">
            </div>

            <div class="form-group col-md-12">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"
                       data-toggle="tooltip" data-placement="top" title="@lang('If the document has on communication to another party , please provide it ')"
                >@lang('In communication to')</label>
                <input type="text" name="communication_a" value="{{ $file->communication_a }}"  class="form-control" placeholder="@lang('If the document has on communication to another party , please provide it ')">
            </div>
        </div>
        {{-- End expiditeur & destinataire & communication_a --}}

        <hr>


        {{-- Start sig_ext & sig_int --}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"
                       data-toggle="tooltip" data-placement="top" title="@lang('Usually,the name of the signer can be found at bottom of the document')"
                >
                    @lang('The signature of sender')
                </label>
                <input type="text" name="sig_ext" value="{{ $file->sig_ext }}" class="form-control" placeholder="@lang('Usually,the name of the signer can be found at bottom of the document')">
            </div>

            <div class="form-group col-md-6">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"
                       data-toggle="tooltip" data-placement="top" title="@lang("It's not always available on document,if available provide it")"

                >@lang('The signature of receiver')</label>
                <input type="text" name="sig_int" class="form-control" value="{{ $file->sig_int }}" placeholder="@lang("It's not always available on document,if available provide it")">
            </div>

        </div>
        {{-- End sig_ext & sig_int --}}



        {{-- Start num_text & num_enrg --}}
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"
                       data-toggle="tooltip" data-placement="top" title="@lang('Sender registration number can be found in top of document')"
                >
                    @lang('Document number')
                </label>
                <input type="text" name="num_text" value="{{ $file->num_text }}" class="form-control" placeholder="@lang('Sender registration number')">
            </div>

            <div class="form-group col-md-4">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"
                       data-toggle="tooltip" data-placement="top" title="@lang("Receiver registration Number")"

                >@lang('Registration Number')</label>
                <input type="text" name="num_enrg" value="{{ $file->num_enrg }}" class="form-control" placeholder="@lang("Receiver registration Number")">
            </div>


            <div class="form-group col-md-4">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Importance')</label>

                {!! Form::select('importance', $importances,$file->importance,
                    ['class' => 'custom-select', 'id' => 'importance']) !!}
            </div>

        </div>
        {{-- End num_text & num_enrg --}}




        {{-- Start date_arrivee & heur_arrivee & nombre_page  --}}
        <div class="form-row">


            <div class="form-group col-md-5">

                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Arrival date')</label>

                <input type="text" id="arrivee" class="form-control" value="{{ $file->date_arrivee }}" name="date_arrivee"
                       placeholder="@lang('Select arrival date')" autocomplete="off"
                >
            </div>

            <div class="form-group col-md-3">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Arrival hour')</label>
                <input type="text" id="arriveeHour" value="{{ $file->heur_arrivee }}" class="form-control" name="heur_arrivee"
                       placeholder="@lang('Select arrival hour')"
                >
            </div>

            <div class="form-group col-md-4">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Number of pages')</label>
                {!! Form::select('nombre_page', $pageNumbers,$file->nombre_page,
                    ['class' => 'custom-select', 'id' => 'nombre_page']) !!}
            </div>
        </div>
        {{-- End date_arrivee & heur_arrivee & nombre_page  --}}

        <hr>


        <button type="submit" class="btn btn-primary">@lang('Save')</button>

        {!! Form::close()!!}
    </div>

    <div class="col-md-5">
        <embed id="documentSource" src="{{ $file->file_path  }}"
               frameborder="0" width="100%" height="460px">
    </div>


</div>

</div>