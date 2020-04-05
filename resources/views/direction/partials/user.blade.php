@if($create)

<div class="divider-text">@lang('Login Details')</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h5 class="card-title">
                    @lang('Login Details')
                </h5>
                <p class="text-muted font-weight-light">
                    @lang('Details used for authenticating with the application.')
                </p>
            </div>
            <div class="col-md-9">
                @include('user.partials.auth', ['edit' => false])
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i data-feather="plus"></i>
                    @lang('Add Direction')
                </button>
            </div>
        </div>
    </div>
</div>
@endif
