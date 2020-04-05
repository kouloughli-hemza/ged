<div id="registrationForm">
    <h3>@lang('Direction information')</h3>
    <section>
        {{-- Start Direction Details --}}
        @include('direction.partials.details', ['edit' => false])
        {{-- End Direction Details --}}
    </section>

    <h3>@lang('User details')</h3>
    <section>
        {{-- Start User Details --}}
        @include('user.partials.auth', ['edit' => false])
        {{-- End User Details --}}
    </section>
</div>