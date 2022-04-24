<li class="menu-item">
    <a href="{{ $link }}" class="menu-item-link {{ $active }} @if(request()->url() == $link) active @endif">
        <span>
            <i class="{{ $class }}"></i>
            {{ $name }}
        </span>
        <span class="badge badge-pill bg-white shadow-sm text-primary">{{ $counter }}</span>
    </a>
</li>
