@php
    use App\Support\Locales;

    $nav = [
        ['route' => 'services', 'label' => __('site.nav.services')],
        ['route' => 'agents', 'label' => __('site.nav.agents')],
        ['route' => 'products', 'label' => __('site.nav.products')],
        ['route' => 'cases', 'label' => __('site.nav.cases')],
        ['route' => 'about', 'label' => __('site.nav.about')],
    ];

    $current = Str::after(Route::currentRouteName() ?? '', '.');
@endphp

<header data-header
        class="fixed inset-x-0 top-0 z-50 transition-all duration-300 [&.is-scrolled]:bg-ink-950/80 [&.is-scrolled]:backdrop-blur-xl [&.is-scrolled]:shadow-[0_1px_0_0_rgb(255_255_255/0.08)]">
    <nav class="mx-auto flex h-20 max-w-7xl items-center justify-between gap-6 px-5 sm:px-8" aria-label="{{ __('site.nav.menu') }}">

        <a href="{{ Locales::route('home') }}" class="group flex shrink-0 items-center gap-2.5 text-white">
            <img src="{{ asset('images/leadabox-mark.svg') }}" alt="" width="36" height="36"
                 class="h-9 w-9 transition-transform duration-500 group-hover:rotate-12">
            <span class="text-lg font-bold tracking-tight">Leadabox</span>
        </a>

        <ul class="hidden items-center gap-1 lg:flex">
            @foreach ($nav as $item)
                <li>
                    <a href="{{ Locales::route($item['route']) }}"
                       @class([
                           'rounded-full px-4 py-2 text-sm font-medium transition-colors',
                           'text-white bg-white/10' => str_starts_with($current, Str::before($item['route'], 's')) && $current === $item['route'],
                           'text-ink-300 hover:text-white hover:bg-white/5' => $current !== $item['route'],
                       ])>
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="flex items-center gap-2">
            <x-site.language-switcher class="hidden sm:block" />

            <a href="{{ Locales::route('contact') }}"
               class="hidden rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-ink-950 transition-all hover:bg-brand-100 hover:shadow-[0_0_30px_-6px_rgb(93_140_255/0.8)] md:inline-flex">
                {{ __('site.nav.contact') }}
            </a>

            <button type="button" data-menu-toggle aria-expanded="false" aria-controls="mobile-menu"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/15 bg-white/5 text-white lg:hidden">
                <span class="sr-only">{{ __('site.nav.menu') }}</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="h-5 w-5">
                    <path d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
            </button>
        </div>
    </nav>
</header>

{{-- Mobile menu --}}
<div id="mobile-menu" data-menu-panel hidden
     class="fixed inset-0 z-[60] bg-ink-950/95 backdrop-blur-2xl lg:hidden">
    <div class="flex h-20 items-center justify-between px-5 sm:px-8">
        <a href="{{ Locales::route('home') }}" class="flex items-center gap-2.5 text-white">
            <img src="{{ asset('images/leadabox-mark.svg') }}" alt="" width="36" height="36" class="h-9 w-9">
            <span class="text-lg font-bold tracking-tight">Leadabox</span>
        </a>
        <button type="button" data-menu-toggle
                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/15 bg-white/5 text-white">
            <span class="sr-only">{{ __('site.nav.close') }}</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="h-5 w-5">
                <path d="M6 6l12 12M18 6L6 18"/>
            </svg>
        </button>
    </div>

    <nav class="flex h-[calc(100%-5rem)] flex-col justify-between overflow-y-auto px-5 pb-10 sm:px-8">
        <ul class="space-y-1 pt-4">
            @foreach ($nav as $item)
                <li>
                    <a href="{{ Locales::route($item['route']) }}"
                       class="flex items-center justify-between rounded-2xl px-4 py-4 text-2xl font-semibold text-white transition-colors hover:bg-white/5">
                        {{ $item['label'] }}
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5 text-ink-500 rtl:rotate-180">
                            <path d="M9 6l6 6-6 6"/>
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="space-y-5 pt-8">
            <a href="{{ Locales::route('contact') }}"
               class="flex w-full items-center justify-center rounded-full bg-white px-6 py-4 text-base font-semibold text-ink-950">
                {{ __('site.nav.cta') }}
            </a>
            <x-site.language-switcher :inline="true" />
        </div>
    </nav>
</div>
