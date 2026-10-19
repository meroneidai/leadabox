@php use App\Support\Locales; @endphp

<x-layouts.site :seo="$seo">

    <x-ui.page-hero
        :crumbs="$seo->breadcrumbs"
        :eyebrow="$copy['title']"
        :title="$copy['hero_title']"
        :body="$copy['hero_body']"
    >
        <div class="reveal mt-10 flex flex-col gap-3 sm:flex-row" data-reveal-delay="240">
            <a href="{{ Locales::route('contact') }}"
               class="group inline-flex items-center justify-center gap-2 rounded-full bg-white px-7 py-4 text-base font-semibold text-ink-950 transition-all hover:shadow-[0_0_40px_-8px_rgb(93_140_255/0.9)]">
                {{ __('site.common.get_started') }}
                <x-ui.icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
            </a>
            <a href="{{ Locales::route('cases') }}"
               class="inline-flex items-center justify-center rounded-full border border-white/20 px-7 py-4 text-base font-semibold text-white transition-colors hover:bg-white/5">
                {{ __('site.common.view_case') }}
            </a>
        </div>
    </x-ui.page-hero>

    {{-- Intro --}}
    <section class="relative py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="ring-gradient reveal rounded-[1.75rem] glass p-8 lg:p-12">
                <div class="grid gap-8 lg:grid-cols-[1fr_1.4fr] lg:gap-16">
                    <h2 class="text-balance text-2xl font-bold text-white lg:text-3xl">{{ $copy['intro_title'] }}</h2>
                    <p class="text-pretty text-lg leading-relaxed text-ink-300">{{ $copy['intro_body'] }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Capabilities --}}
    @if (! empty($copy['capabilities']))
        <section class="relative py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 sm:px-8">
                <x-ui.section-heading :title="__('site.common.what_we_deliver')" />

                <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($copy['capabilities'] as $key => $capability)
                        <div class="reveal rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition-colors hover:border-white/20"
                             data-reveal-delay="{{ $loop->index * 60 }}">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500/15 text-brand-200 ring-1 ring-inset ring-white/10">
                                <x-ui.icon name="check" class="h-4 w-4" />
                            </span>
                            <h3 class="mt-5 text-base font-semibold text-white">{{ $capability['title'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-ink-400">{{ $capability['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Stack --}}
    <section class="relative py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <h2 class="reveal text-sm font-semibold uppercase tracking-[0.14em] text-ink-400">{{ __('site.common.our_stack') }}</h2>
            <ul class="reveal mt-6 flex flex-wrap gap-2.5" data-reveal-delay="80">
                @foreach ($service['stack'] as $tech)
                    <li class="rounded-full border border-white/10 bg-white/[0.04] px-4 py-2 text-sm font-medium text-ink-200">{{ $tech }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-ui.faq :faqs="$seo->faqs" :title="$copy['title'] . ' — ' . __('site.common.faq_title')" />

    {{-- Related --}}
    <section class="relative pb-8">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <h2 class="reveal text-sm font-semibold uppercase tracking-[0.14em] text-ink-400">{{ __('site.common.related_services') }}</h2>
            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                @foreach ($related as $relatedSlug => $relatedService)
                    <a href="{{ Locales::route('service', ['service' => $relatedSlug]) }}"
                       class="reveal group rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition-all hover:-translate-y-1 hover:border-white/25"
                       data-reveal-delay="{{ $loop->index * 60 }}">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/5 text-brand-200 ring-1 ring-inset ring-white/10">
                            <x-ui.icon :name="$relatedService['icon']" class="h-4 w-4" />
                        </span>
                        <h3 class="mt-4 font-semibold text-white">{{ __("site.services.items.{$relatedSlug}.title") }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-400">{{ __("site.services.items.{$relatedSlug}.short") }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.cta />

</x-layouts.site>
