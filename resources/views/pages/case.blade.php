@php use App\Support\Locales; @endphp

<x-layouts.site :seo="$seo">

    <x-ui.page-hero
        :crumbs="$seo->breadcrumbs"
        :eyebrow="$case['client'] . ' · ' . $case['year']"
        :title="$copy['title']"
        :body="$copy['short']"
    >
        <div class="reveal mt-10 flex flex-wrap items-center gap-3" data-reveal-delay="240">
            <a href="{{ $case['url'] }}" target="_blank" rel="noopener"
               class="group inline-flex items-center justify-center gap-2 rounded-full bg-white px-7 py-4 text-base font-semibold text-ink-950 transition-all hover:shadow-[0_0_40px_-8px_rgb(93_140_255/0.9)]">
                {{ __('site.cases.visit_site') }}
                <x-ui.icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
            </a>
            @foreach ($case['domains'] as $domain)
                <span class="rounded-full border border-white/15 px-4 py-2 text-sm font-medium text-ink-300">{{ $domain }}</span>
            @endforeach
        </div>
    </x-ui.page-hero>

    {{-- Metrics --}}
    <section class="relative pb-16">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <dl class="grid grid-cols-2 gap-px overflow-hidden rounded-3xl border border-white/10 bg-white/5 lg:grid-cols-4">
                @foreach ($case['metrics'] as $metric)
                    <div class="reveal bg-ink-950/60 p-8 text-center" data-reveal-delay="{{ $loop->index * 70 }}">
                        <dd class="text-4xl font-bold text-gradient lg:text-5xl">{{ $metric['value'] }}</dd>
                        <dt class="mt-2 text-sm text-ink-400">{{ __("site.cases.metrics.{$metric['key']}") }}</dt>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    {{-- Narrative --}}
    <section class="relative py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="space-y-5">
                @foreach ([
                    ['label' => __('site.cases.the_challenge'), 'body' => $copy['challenge'], 'accent' => 'rose'],
                    ['label' => __('site.cases.what_we_did'), 'body' => $copy['solution'], 'accent' => 'brand'],
                    ['label' => __('site.cases.the_result'), 'body' => $copy['result'], 'accent' => 'emerald'],
                ] as $block)
                    <article class="reveal rounded-[1.75rem] border border-white/10 bg-white/[0.03] p-8 lg:p-12" data-reveal-delay="{{ $loop->index * 80 }}">
                        <div class="grid gap-6 lg:grid-cols-[0.5fr_1.5fr] lg:gap-12">
                            <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-brand-300">{{ $block['label'] }}</h2>
                            <p class="text-pretty text-lg leading-relaxed text-ink-200">{{ $block['body'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Services used --}}
    <section class="relative pb-8">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <h2 class="reveal text-sm font-semibold uppercase tracking-[0.14em] text-ink-400">{{ __('site.common.related_services') }}</h2>
            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                @foreach ($case['services'] as $serviceSlug)
                    @php $serviceConfig = config("site.services.{$serviceSlug}"); @endphp
                    <a href="{{ Locales::route('service', ['service' => $serviceSlug]) }}"
                       class="reveal group rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition-all hover:-translate-y-1 hover:border-white/25"
                       data-reveal-delay="{{ $loop->index * 60 }}">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/5 text-brand-200 ring-1 ring-inset ring-white/10">
                            <x-ui.icon :name="$serviceConfig['icon']" class="h-4 w-4" />
                        </span>
                        <h3 class="mt-4 font-semibold text-white">{{ __("site.services.items.{$serviceSlug}.title") }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-400">{{ __("site.services.items.{$serviceSlug}.short") }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.faq :faqs="$seo->faqs" />

    <x-ui.cta />

</x-layouts.site>
