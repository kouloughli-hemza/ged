@if ($item && $item->authorize(auth()->user()))
    <li class="{{ isset($child) ? 'nav-sub-item' : 'nav-item' }}{{ $item->isDropDown() ? ' with-sub' : '' }}{{ Request::is($item->getActivePath()) ? ' active' : '' }}">
        <a class="{{ isset($child) ? 'nav-sub-link' : 'nav-link' }}"
           href="{{ $item->getHref() }}"

        >
            @if ($item->getIcon())
                <i class="{{ $item->getIcon() }}"></i>
            @endif

            {{ $item->getTitle() }}
        </a>

        @if ($item->isDropdown())
            <ul class="navbar-menu-sub">
                @foreach ($item->children() as $child)
                    @include('partials.theme.menu.items', ['item' => $child])
                @endforeach
            </ul>
        @endif
    </li>
@endif
