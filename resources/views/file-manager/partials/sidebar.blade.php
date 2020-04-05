<div class="filemgr-sidebar">

    {{-- =========== Start File Upload Button Modal ===== ---}}
    <div class="filemgr-sidebar-header">
        <div class="dropdown dropdown-icon flex-fill">
            <button class="btn btn-xs btn-block btn-primary" data-toggle="dropdown">
                <i data-feather="upload-cloud"></i>
                @lang('New document') 
                <i data-feather="chevron-down"></i>
            </button>
            <div class="dropdown-menu tx-13">
              
              <a href="#modalFileScanner" data-toggle="modal" class="dropdown-item"><i data-feather="folder"></i><span>@lang('From Scanner')</span></a>

              <a href="#modalFile" data-toggle="modal" class="dropdown-item">
                <i data-feather="file"></i>
                <span>@lang('Local File')</span>
               </a>

            </div>
          </div>
    </div>


    {{-- =========== End File Upload Button Modal ===== ---}}


    <div class="filemgr-sidebar-body">
    <div class="pd-t-20 pd-b-10 pd-x-10">
        <label class="tx-sans tx-uppercase tx-medium tx-10 tx-spacing-1 tx-color-03 pd-l-10">@lang('GED Mila')</label>
        <nav class="nav nav-sidebar tx-13">
           <span style="cursor: pointer"
                 data-value="recent"
                 class="nav-link   order-by {{ Request::has('order_by') && Request::get('order_by') == 'recent' ? 'active' : ''  }}" >
               <i data-feather="folder"></i>
                <span>
                    @lang('Recent Documents')

                </span>
                @if(Request::has('order_by') && Request::get('order_by') == 'recent')
                   <span id="navbarSearchClose" class="link-03 mg-l-5 mg-lg-l-10 deleteOrder"><i data-feather="x"></i></span>
                @endif
            </span>


            <span style="cursor: pointer"
                  data-value="last-updated"
                  class="nav-link order-by {{ Request::has('order_by') && Request::get('order_by') == 'last-updated' ? 'active' : ''  }}" >
               <i data-feather="folder"></i>
                <span>
                    @lang('Recently updated')

                </span>
                @if(Request::has('order_by') && Request::get('order_by') == 'last-updated')
                    <span id="navbarSearchClose" class="link-03 mg-l-5 mg-lg-l-10 deleteOrder"><i data-feather="x"></i></span>
                @endif
            </span>

        </nav>
    </div>
    <div class="pd-10">
        <label class="tx-sans tx-uppercase tx-medium tx-10 tx-spacing-1 tx-color-03 pd-l-10">@lang('Document by importance')</label>
        <nav class="nav nav-sidebar tx-13">
            <span style="cursor: pointer"
                  data-value="{{ \Kouloughli\Support\Enum\FileImportance::SECRET }}"
                  class="nav-link importance {{ Request::has('importance') && Request::get('importance') == \Kouloughli\Support\Enum\FileImportance::SECRET ? 'active' : ''  }}" ><i data-feather="shield"></i>
                <span>
                    @lang('app.importance.secret')

                </span>
                @if(Request::has('importance') && Request::get('importance') == \Kouloughli\Support\Enum\FileImportance::SECRET)
                <span id="navbarSearchClose" class="link-03 mg-l-5 mg-lg-l-10 deleteImportance"><i data-feather="x"></i></span>
                @endif
            </span>

            <span style="cursor: pointer" data-value="{{ \Kouloughli\Support\Enum\FileImportance::VERYSECRET }}" class="nav-link importance {{ Request::has('importance') && Request::get('importance') == \Kouloughli\Support\Enum\FileImportance::VERYSECRET ? 'active' : ''  }}">
                <i data-feather="lock"></i>
                <span>
                    @lang('app.importance.very secret')
                </span>
                 @if(Request::has('importance') && Request::get('importance') == \Kouloughli\Support\Enum\FileImportance::VERYSECRET)
                    <span id="navbarSearchClose"  class="link-03 mg-l-5 mg-lg-l-10 deleteImportance"><i data-feather="x"></i></span>
                @endif
            </span>
            <span style="cursor: pointer" data-value="{{ \Kouloughli\Support\Enum\FileImportance::URGENT }}" class="nav-link importance {{ Request::has('importance') && Request::get('importance') == \Kouloughli\Support\Enum\FileImportance::URGENT ? 'active' : ''  }}">
                <i data-feather="alert-circle"></i>
                <span>@lang('app.importance.urgent')</span>
                @if(Request::has('importance') && Request::get('importance') == \Kouloughli\Support\Enum\FileImportance::URGENT)
                    <span id="navbarSearchClose"  class="link-03 mg-l-5 mg-lg-l-10 deleteImportance"><i data-feather="x"></i></span>
                @endif
            </span>
        </nav>
    </div>


    {{-- ===== Start Storage Status ====== --}}
    <div class="pd-y-10 pd-x-20">
        <label class="tx-sans tx-uppercase tx-medium tx-10 tx-spacing-1 tx-color-03 mg-b-15">@lang('Storage status')</label>
        <div class="media">
            <i data-feather="database" class="wd-30 ht-30"></i>
            <div class="media-body mg-l-10">
                <div class="tx-10 mg-b-4">{{ $space['usedSpace']  . ' ' . trans('Used of') . ' ' . $space["totalSpace"]}}</div>
                <div class="progress ht-3 mg-b-20">
                    <div class="progress-bar wd-15p" role="progressbar" aria-valuenow="{{$space['spacePercentage']}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        {{--<p class="tx-12">Get 2TB (2,000GB) of storage now and get 40% off. Offers ends soon. <a href="">Learn more</a></p>--}}
    </div>
    {{-- ===== End Storage Status ====== --}}

    </div>
</div>