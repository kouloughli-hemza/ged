<tr>
    <td class="align-middle">
        <a href="#">
            {{ $direction->direc_name ?: __('N/A') }}
        </a>
    </td>
    <td class="align-middle">{{ $direction->direc_description}}</td>
    <td class="align-middle">{{ $direction->direc_email }}</td>
    <td class="align-middle">{{ $direction->direc_phone }}</td>
    <td class="align-middle text-center">{{ $direction->files_count }}</td>
    <td class="align-middle">{{ $direction->created_at->format(config('app.date_format')) }}</td>
    <td class="align-middle">
        <span class="badge  badge-{{ $direction->present()->labelClass }}">
            {{ trans("app.status.{$direction->direc_status}") }}
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
                @canBeImpersonated($direction->users[0])
                <a href="{{ route('impersonate', $direction->users[0]) }}"  class="dropdown-item impersonate">
                    <i data-feather="lock"></i>@lang('Impersonate')
                </a>
                @endCanBeImpersonated
            </div>
        </div>

        <a href="{{ route('directions.edit', $direction) }}"
           class="btn btn-icon edit"
           title="@lang('Edit Direction')"
           data-toggle="tooltip" data-placement="top">
            <i data-feather="edit"></i>
        </a>

        <a href="{{ route('directions.destroy', $direction) }}"
           class="btn btn-icon"
           title="@lang('Delete Direction')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('Please Confirm')"
           data-confirm-text="@lang('Are you sure that you want to delete this Direction?')"
           data-confirm-delete="@lang('Yes, delete him!')">
            <i data-feather="trash"></i>
        </a>
    </td>
</tr>