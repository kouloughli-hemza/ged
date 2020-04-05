<div class="modal fade" id="modalFileScanner" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg wd-sm-650" role="document">
        <div class="modal-content">

            {{-- Start File Modal Header --}}
            {{--<div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
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
            </div>--}}
            {{-- End File Modal Header --}}


            <div class="modal-body p-0">

                @include('file-manager.partials.wizard.wizard')

            </div>

            <div class="modal-footer pd-x-20 pd-y-15">
                <button type="button" class="btn btn-white" data-dismiss="modal">@lang('Cancel')</button>
                {{--<button type="submit" class="btn btn-primary">@lang('Save')</button>--}}
            </div>
        </div>{{-- modal-content --}}
    </div>{{-- modal-dialog --}}
</div>{{-- modal --}}

