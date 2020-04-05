<tr>
    <td class="tx-color-03 tx-normal">
        <a href="{{ route('users.show', $user) }}">
            <img
                class="rounded-circle img-responsive"
                width="40"
                src="{{ $user->present()->avatar }}"
                alt="{{ $user->present()->name }}">
        </a>
    </td>
    <td class="align-middle">
        <a href="{{ route('users.show', $user) }}">
            {{ $user->username ?: __('N/A') }}
        </a>
    </td>
    <td class="align-middle">{{ $user->present()->name }}</td>
    <td class="align-middle">{{ $user->email }}</td>
    <td class="align-middle">{{ $user->direction->direc_name }}</td>
    <td class="align-middle">{{ $user->role->role_name }}</td>
    <td class="align-middle">
        {{ $user->created_at->format(config('app.date_format')) }}
        <br>
        <small class="tx-11 tx-warning  letter-spacing--2">
            {{ $user->created_at->diffForHumans() }}
        </small>

    </td>
    <td class="align-middle">
        <span class="badge  badge-{{ $user->present()->labelClass }}">
            {{ trans("app.status.{$user->status}") }}
        </span>
    </td>
    <td class="text-center align-middle">
        <div class="dropdown show d-inline-block dropdown-file">
            <a class="btn btn-icon"
               href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i data-feather="more-vertical"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                @if (config('session.driver') == 'database')
                    <a href="{{ route('user.sessions', $user) }}" class="dropdown-item text-gray-500">
                        <i data-feather="life-buoy"></i>
                        @lang('User Sessions')
                    </a>
                @endif
                <a href="{{ route('users.show', $user) }}" class="dropdown-item text-gray-500">
                    <i data-feather="eye"></i>
                    @lang('View User')
                </a>

                @canBeImpersonated($user)
                    <a href="{{ route('impersonate', $user) }}" class="dropdown-item text-gray-500 impersonate">
                        <i data-feather="lock"></i>
                        @lang('Impersonate')
                    </a>
                @endCanBeImpersonated
            </div>
        </div>

        <a href="{{ route('users.edit', $user) }}"
           class="btn btn-icon edit"
           title="@lang('Edit User')"
           data-toggle="tooltip" data-placement="top">
            <i data-feather="edit"></i>
        </a>

        <a href="{{ route('users.destroy', $user) }}"
           class="btn btn-icon"
           title="@lang('Delete User')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('Please Confirm')"
           data-confirm-text="@lang('Are you sure that you want to delete this user?')"
           data-confirm-delete="@lang('Yes, delete him!')">
            <i data-feather="trash"></i>
        </a>
    </td>
</tr>