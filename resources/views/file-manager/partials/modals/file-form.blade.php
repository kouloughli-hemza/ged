<div class="modal fade" id="modalFile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg wd-sm-650" role="document">
        <div class="modal-content">

            {{-- Start File Modal Header --}}
            <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
                <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-18 tx-sm-20 mg-b-2">@lang('File Details')</h4>
                        <p class="tx-13 tx-color-03 mg-b-0">@lang('Make sure to fill all form data')</p>
                    </div>
                </div>
            </div>
            {{-- End File Modal Header --}}


            <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">

            {!! Form::open(['route' => 'files.store', 'id' => 'file-form','files' => 'true']) !!}
            {{ csrf_field() }}
                {{-- Start Document Object --}}
                <div class="form-group">
                    <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"
                           data-toggle="tooltip" data-placement="top" title="@lang('Document object')"
                    >@lang('Object')</label>
                    <input type="text" name="objet" class="form-control" placeholder="@lang('Document object')">
                </div>
                {{-- End Document Object --}}



                {{-- Start expiditeur & destinataire & communication_a --}}
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Sender')</label>
                        <input type="text" name="expiditeur" class="form-control" placeholder="@lang('Please provide the sender of the document')">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Recipient')</label>
                        <input type="text" name="destinataire" class="form-control" placeholder="@lang('Please provide the receiver of the document')">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"
                               data-toggle="tooltip" data-placement="top" title="@lang('If the document has on communication to another party , please provide it ')"
                        >@lang('In communication to')</label>
                        <input type="text" name="communication_a" class="form-control" placeholder="@lang('If the document has on communication to another party , please provide it ')">
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
                        <input type="text" name="sig_ext" class="form-control" placeholder="@lang('Usually,the name of the signer can be found at bottom of the document')">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"
                               data-toggle="tooltip" data-placement="top" title="@lang("It's not always available on document,if available provide it")"

                        >@lang('The signature of receiver')</label>
                        <input type="text" name="sig_int" class="form-control" placeholder="@lang("It's not always available on document,if available provide it")">
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
                        <input type="text" name="num_text" class="form-control" placeholder="@lang('Sender registration number')">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"
                               data-toggle="tooltip" data-placement="top" title="@lang("Receiver registration Number")"

                        >@lang('Registration Number')</label>
                        <input type="text" name="num_enrg" class="form-control" placeholder="@lang("Receiver registration Number")">
                    </div>


                    <div class="form-group col-md-4">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Importance')</label>

                        {!! Form::select('importance', $importances,'',
                            ['class' => 'custom-select', 'id' => 'importance']) !!}
                    </div>

                </div>
                {{-- End num_text & num_enrg --}}




                {{-- Start date_arrivee & heur_arrivee & nombre_page  --}}
                <div class="form-row">


                    <div class="form-group col-md-5">

                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Arrival date')</label>

                        <input type="text" id="arrivee" class="form-control" name="date_arrivee"
                               placeholder="@lang('Select arrival date')" autocomplete="off"
                        >
                    </div>

                    <div class="form-group col-md-3">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Arrival hour')</label>
                        <input type="text" id="arriveeHour" class="form-control" name="heur_arrivee"
                               placeholder="@lang('Select arrival hour')"
                        >
                    </div>

                    <div class="form-group col-md-4">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">@lang('Number of pages')</label>
                        {!! Form::select('nombre_page', $pageNumbers,'',
                    ['class' => 'custom-select', 'id' => 'nombre_page']) !!}
                    </div>
                </div>
                {{-- End date_arrivee & heur_arrivee & nombre_page  --}}

                <hr>

                @include('file-manager.partials.uploader')
            </div>

            <div class="modal-footer pd-x-20 pd-y-15">
                <button type="button" class="btn btn-white" data-dismiss="modal">@lang('Cancel')</button>
                <button type="submit" class="btn btn-primary">@lang('Save')</button>
            </div>
            {!! Form::close()!!}
        </div>{{-- modal-content --}}
    </div>{{-- modal-dialog --}}
</div>{{-- modal --}}

@push('custom-scripts')
    {!! JsValidator::formRequest('Kouloughli\Http\Requests\File\CreateFileRequest', '#file-form') !!}
@endpush