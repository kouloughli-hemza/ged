<div class="modal fade effect-scale" id="modalViewDetails" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
                    </div>
                </div>
            </div>
            {{-- End File Modal Header --}}


            <div class="modal-body pd-20 pd-sm-30">


                <div class="col-sm-12 col-lg-12 mg-t-10">
                    <div>
                        <div>
                            <p class="tx-uppercase tx-11 tx-spacing-1 tx-color-03 tx-medium mg-b-5">
                                @lang('Added by direction')
                            </p>
                            <h3 class="tx-26 tx-normal tx-rubik tx-spacing--2 mg-b-5" id="direction"></h3>
                            <div class="d-flex mg-b-25">
                                <p class="tx-12 tx-rubik mg-b-0" id="created_at"></p>
                                <p class="tx-12 tx-rubik mg-b-0 mg-l-10"><span class="tx-medium tx-success mg-r-5" id="created_at_humans"></span></p>
                            </div>


                            <div class="d-flex align-items-center justify-content-between mg-b-10">
                                <p class="tx-uppercase tx-11 tx-spacing-1 tx-color-03 tx-medium mg-b-0">@lang('Details')</p>
                            </div>
                            <ul class="list-group list-group-flush mg-b-0 tx-13">
                                <li class="list-group-item pd-x-0 d-flex justify-content-between">
                                    <span class="tx-medium">@lang('Object')</span>
                                    <span class="tx-rubik" id="objectDetails"></span>
                                </li>
                                <li class="list-group-item pd-x-0 d-flex justify-content-between">
                                    <span class="tx-medium">@lang('Sender')</span>
                                    <span class="tx-rubik" id="senderDetails"></span>
                                </li>
                                <li class="list-group-item pd-x-0 d-flex justify-content-between">
                                    <span class="tx-medium">@lang('Recipient')</span>
                                    <span class="tx-rubik" id="receiverDetails"></span>
                                </li>
                                <li class="list-group-item pd-x-0 d-flex justify-content-between">
                                    <span class="tx-medium">@lang('Number of pages')</span>
                                    <span class="tx-rubik" id="pagesNumberDetails"></span>
                                </li>
                                <li class="list-group-item pd-x-0 d-flex justify-content-between">
                                    <span class="tx-medium">@lang('Arrival date')</span>
                                    <div class="tx-rubik" id="arrivalDateDetails"></div>
                                    <span class="tx-medium tx-success mg-r-5" id="diffArrivalDate"></span>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mg-sm-l-5" data-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>