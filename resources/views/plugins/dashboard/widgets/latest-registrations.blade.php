<div class="col-md-6 col-xl-4 mg-t-10">
    <div class="card ht-100p">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="mg-b-0">@lang('Latest Registrations')</h6>
        </div>
        @php
         $classes = array("bg-gray-600", "bg-orange","bg-indigo", "bg-teal");
        @endphp
        @if (count($latestRegistrations))
        <ul class="list-group list-group-flush tx-13">
            @foreach ($latestRegistrations as $user)
            <li class="list-group-item d-flex pd-sm-x-20">
                <div class="avatar"><span class="avatar-initial rounded-circle {{ $classes[@array_rand($classes)] }}">s</span></div>
                <div class="pd-l-10">
                    <p class="tx-medium mg-b-0">{{ $user->present()->nameOrEmail }}</p>
                    <small class="tx-12 tx-color-03 mg-b-0">{{ $user->created_at->diffForHumans() }}</small>
                </div>
                <div class="mg-l-auto d-flex align-self-center">
                    <nav class="nav nav-icon-only">
                        <a href="{{ route('users.show', $user) }}" class="nav-link d-none d-sm-block">
                            <i data-feather="user"></i>
                        </a>
                    </nav>
                </div>
            </li>
            @endforeach
        </ul>
        @else
            <p class="text-muted">@lang('No records found.')</p>
        @endif
        <div class="card-footer text-center tx-13">
            @if (count($latestRegistrations))
            <a href="{{ route('users.index') }}" class="link-03">@lang('View All') <i class="icon ion-md-arrow-down mg-l-5"></i></a>
            @endif
        </div>{{-- card-footer --}}
    </div>{{-- card --}}
</div>
