@php
    use App\Support\Locales;
    $seo = \App\Support\Seo::make()
        ->title(__('site.errors.404_title'))
        ->description(__('site.errors.404_body'))
        ->noindex();
@endphp

<x-layouts.site :seo="$seo">
    <section class="relative flex min-h-[70vh] items-center">
        <div class="mx-auto max-w-3xl px-5 py-24 text-center sm:px-8">
            <p class="text-[8rem] font-extrabold leading-none text-gradient sm:text-[12rem]">404</p>

            <h1 class="mt-4 text-balance text-3xl font-bold text-white sm:text-4xl">{{ __('site.errors.404_title') }}</h1>
            <p class="mt-5 text-pretty text-lg leading-relaxed text-ink-300">{{ __('site.errors.404_body') }}</p>

            <div class="mt-10 flex flex-wrap justify-center gap-3">
                <a href="{{ Locales::route('home') }}"
                   class="rounded-full bg-white px-6 py-3.5 text-base font-semibold text-ink-950 transition-all hover:shadow-[0_0_40px_-8px_rgb(93_140_255/0.9)]">
                    {{ __('site.errors.home_link') }}
                </a>
                @foreach (['services', 'agents', 'products', 'contact'] as $route)
                    <a href="{{ Locales::route($route) }}"
                       class="rounded-full border border-white/20 px-6 py-3.5 text-base font-medium text-white transition-colors hover:bg-white/5">
                        {{ __("site.nav.{$route}") }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.site>
