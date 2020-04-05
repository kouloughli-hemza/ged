<div class="col-lg-6 col-xl-6 mg-t-10">
    <div class="card">
        <div class="card-body pd-20">

            <div id="performance" class="tab-pane fade active show">

                <h6 class="tx-uppercase tx-spacing-1 tx-semibold tx-10 tx-color-02 mg-b-15">@lang('Documents by direction')</h6>
                <div class="progress bg-transparent op-7 ht-10 mg-b-20">
                    <div class="progress-bar bg-primary wd-50p" role="progressbar" aria-valuenow="30" aria-valuemin="0"
                         aria-valuemax="100"></div>
                    <div class="progress-bar bg-success wd-25p bd-l bd-white" role="progressbar" aria-valuenow="15"
                         aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-warning wd-5p bd-l bd-white" role="progressbar" aria-valuenow="5"
                         aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-pink wd-5p bd-l bd-white" role="progressbar" aria-valuenow="5"
                         aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-teal wd-10p bd-l bd-white" role="progressbar" aria-valuenow="10"
                         aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-purple wd-5p bd-l bd-white" role="progressbar" aria-valuenow="10"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                @if(count($directions))
                    <table class="table table-sm tx-13 mg-b-0">
                        <tbody>
                        @foreach($directions as $direction)

                            <tr>
                                <td class="align-middle pd-l-0-f">
                                    <div class="wd-15 ht-15 rounded-circle bd bd-3 bd-{{$colors[array_rand($colors)]}}"></div>
                                </td>
                                <td class="tx-medium">{{ $direction->direc_name }}</td>
                                <td class="text-right pd-r-0-f">{{ $direction->files->count() }}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>