<div class="dropdown dropdown-profile">
    <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
        <div class="avatar avatar-sm">
            <img src="{{ auth()->user()->present()->avatar }}" class="rounded-circle" alt="">
        </div>
    </a>{{-- dropdown-link --}}
    <div class="dropdown-menu dropdown-menu-right tx-13">
        <div class="avatar avatar-lg mg-b-15">
            <img src="{{ auth()->user()->present()->avatar }}" class="rounded-circle" alt="">
        </div>
        <h6 class="tx-semibold mg-b-5">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>

        <a href="{{ route('profile') }}" class="dropdown-item"><i data-feather="edit-3"></i>@lang('My Profile')</a>

        {{-- Start Dark MODE Section --}}
        {!! Form::open(['route' => 'setting.dark', 'id' => 'dark-mode-form']) !!}
        <div class="d-flex align-items-center mt-3">
            <div class="d-flex flex-column">
                <a href="#" onclick="return false" style="pointer-events: none; cursor: default;" class="dropdown-item"><i data-feather="moon"></i>@lang('Dark mode')</a>
            </div>

            <div class="custom-control custom-switch">
                <input type="hidden" value="0" name="darkMode">

                <input type="checkbox"
                       class="custom-control-input"
                       value="1"
                       name="darkMode"
                       id="switch-dark-mode"
                       {{ session()->has('darkMode')  ? 'checked' : '' }}>
                <label for="switch-dark-mode" style="cursor: pointer" class="custom-control-label" id="dark-mode-switcher"></label>
            </div>
        </div>
        {!! Form::close() !!}
        {{-- End Dark Mode Section --}}


        <div class="dropdown-divider"></div>
        @if (config('session.driver') == 'database')
            <a href="{{ route('profile.sessions') }}" class="dropdown-item"><i data-feather="life-buoy"></i> @lang('Active Sessions')</a>
        @endif
        <a href="{{ route('auth.logout') }}" class="dropdown-item"><i data-feather="log-out"></i>@lang('Logout')</a>
    </div>{{-- dropdown-menu --}}
</div>{{-- dropdown --}}
