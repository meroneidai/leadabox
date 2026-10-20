@php use App\Support\Locales; @endphp

<x-layouts.site :seo="$seo">

    <x-ui.page-hero
        :crumbs="$seo->breadcrumbs"
        :eyebrow="$product['name']"
        :title="$copy['hero_title']"
        :body="$copy['hero_body']"
    >
        <div class="reveal mt-10 flex flex-col gap-3 sm:flex-row" data-reveal-delay="240">
            <a href="{{ $product['url'] }}" target="_blank" rel="noopener"
               class="group inline-flex items-center justify-center gap-2 rounded-full bg-white px-7 py-4 text-base font-semibold text-ink-950 transition-all hover:shadow-[0_0_40px_-8px_rgb(93_140_255/0.9)]">
                {{ __('site.products.view_on_wp') }}
                <x-ui.icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
            </a>
            <a href="{{ Locales::route('contact') }}"
               class="inline-flex items-center justify-center rounded-full border border-white/20 px-7 py-4 text-base font-semibold text-white transition-colors hover:bg-white/5">
                {{ __('site.common.talk_to_us') }}
            </a>
        </div>

        <div class="reveal mt-8 flex flex-wrap gap-2" data-reveal-delay="300">
            <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-300">{{ __('site.products.free_badge') }} &middot; GPLv2</span>
            <span class="rounded-full bg-white/8 px-3 py-1 text-xs font-medium text-ink-300">{{ $product['category'] }}</span>
            <span class="rounded-full bg-white/8 px-3 py-1 text-xs font-medium text-ink-300">v{{ $product['version'] }}</span>
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

    {{-- Impact --}}
    @if (! empty($copy['impact']))
        <section class="relative py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 sm:px-8">
                <x-ui.section-heading
                    :title="__('site.products.impact_title')"
                    :body="__('site.products.impact_body')"
                />

                <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($copy['impact'] as $metric)
                        <div class="reveal rounded-2xl border border-white/10 bg-white/[0.03] p-6" data-reveal-delay="{{ $loop->index * 70 }}">
                            <p class="text-3xl font-bold text-gradient lg:text-4xl">{{ $metric['value'] }}</p>
                            <h3 class="mt-3 text-sm font-semibold text-white">{{ $metric['label'] }}</h3>
                            <p class="mt-2 text-sm leading-relaxed text-ink-400">{{ $metric['body'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Free features --}}
    <section class="relative py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <x-ui.section-heading :title="__('site.common.what_we_deliver')" />

            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($copy['features'] ?? [] as $key => $feature)
                    <div class="reveal rounded-2xl border border-white/10 bg-white/[0.03] p-6" data-reveal-delay="{{ $loop->index * 60 }}">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-400/15 text-emerald-300 ring-1 ring-inset ring-white/10">
                            <x-ui.icon name="check" class="h-4 w-4" />
                        </span>
                        <h3 class="mt-5 text-base font-semibold text-white">{{ $feature['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-400">{{ $feature['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Pro features --}}
    @if ($product['has_pro'])
        <section class="relative py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 sm:px-8">
                <div class="ring-gradient reveal overflow-hidden rounded-[2rem] glass-strong p-8 lg:p-14">
                    <div class="pointer-events-none absolute inset-0" aria-hidden="true">
                        <div class="absolute -top-1/3 end-1/4 h-[30rem] w-[30rem] rounded-full opacity-30 blur-[100px]"
                             style="background: radial-gradient(circle, #7b2dff, transparent 65%);"></div>
                    </div>

                    <div class="relative">
                        <p class="inline-flex items-center gap-2 rounded-full bg-brand-500/20 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.14em] text-brand-200">
                            {{ __('site.products.pro_badge') }}
                        </p>
                        <h2 class="mt-6 text-balance text-3xl font-bold text-white lg:text-4xl">{{ __('site.products.pro_title') }}</h2>
                        <p class="mt-4 max-w-2xl text-pretty leading-relaxed text-ink-300">{{ __('site.products.pro_body') }}</p>

                        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($copy['pro_features'] ?? [] as $key => $feature)
                                <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-6">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500/20 text-brand-200 ring-1 ring-inset ring-white/10">
                                        <x-ui.icon name="bolt" class="h-4 w-4" />
                                    </span>
                                    <h3 class="mt-5 text-base font-semibold text-white">{{ $feature['title'] }}</h3>
                                    <p class="mt-2 text-sm leading-relaxed text-ink-400">{{ $feature['body'] }}</p>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ Locales::route('contact') }}"
                           class="mt-12 inline-flex items-center justify-center gap-2 rounded-full bg-white px-7 py-4 text-base font-semibold text-ink-950 transition-all hover:shadow-[0_0_40px_-8px_rgb(93_140_255/0.9)]">
                            {{ __('site.common.get_started') }}
                            <x-ui.icon name="arrow" class="h-4 w-4 rtl:rotate-180" />
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- How it works + specs --}}
    @if (! empty($copy['how']) || ! empty($copy['specs']))
        <section class="relative py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 sm:px-8">
                <div class="grid gap-12 lg:grid-cols-[1.25fr_0.75fr] lg:gap-16">

                    @if (! empty($copy['how']))
                        <div>
                            <x-ui.section-heading :title="__('site.products.how_title')" />

                            <ol class="mt-10 space-y-4">
                                @foreach ($copy['how'] as $step)
                                    <li class="reveal flex gap-5 rounded-2xl border border-white/10 bg-white/[0.03] p-6" data-reveal-delay="{{ $loop->index * 50 }}">
                                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-500/20 text-sm font-bold text-brand-200 ring-1 ring-inset ring-white/10">
                                            {{ $loop->iteration }}
                                        </span>
                                        <div>
                                            <h3 class="font-semibold text-white">{{ $step['title'] }}</h3>
                                            <p class="mt-1.5 text-sm leading-relaxed text-ink-400">{{ $step['body'] }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    @endif

                    @if (! empty($copy['specs']))
                        <div class="lg:sticky lg:top-28 lg:self-start">
                            <h2 class="reveal text-sm font-semibold uppercase tracking-[0.14em] text-ink-400">
                                {{ __('site.products.specs_title') }}
                            </h2>
                            <ul class="reveal mt-6 space-y-3 rounded-2xl border border-white/10 bg-white/[0.03] p-6" data-reveal-delay="80">
                                @foreach ($copy['specs'] as $spec)
                                    <li class="flex items-start gap-2.5 text-sm text-ink-300">
                                        <span class="mt-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-emerald-400/20 text-emerald-300">
                                            <x-ui.icon name="check" class="h-2.5 w-2.5" />
                                        </span>
                                        {{ $spec }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <x-ui.faq :faqs="$seo->faqs" :title="$product['name'] . ' — ' . __('site.common.faq_title')" />

    <x-ui.cta />

</x-layouts.site>
