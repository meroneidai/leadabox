@props(['crumbs' => []])

@if (count($crumbs) > 1)
    <nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-5 pt-28 sm:px-8 lg:pt-32">
        <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-ink-500">
            @foreach ($crumbs as $i => $crumb)
                <li class="flex items-center gap-2">
                    @if ($i < count($crumbs) - 1)
                        <a href="{{ $crumb['url'] }}" class="transition-colors hover:text-white">{{ $crumb['name'] }}</a>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3 w-3 text-ink-700 rtl:rotate-180">
                            <path d="M9 6l6 6-6 6"/>
                        </svg>
                    @else
                        <span class="text-ink-300" aria-current="page">{{ $crumb['name'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
