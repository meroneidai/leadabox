@php use App\Support\Locales; @endphp

<x-layouts.site :seo="$seo">

    <x-ui.page-hero
        :crumbs="$seo->breadcrumbs"
        :eyebrow="__('site.cases.eyebrow')"
        :title="__('site.cases.hero_title')"
        :body="__('site.cases.hero_body')"
    />

    <section class="relative pb-8">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="space-y-6">
                @foreach ($cases as $slug => $case)
                    <a href="{{ Locales::route('case', ['case' => $slug]) }}"
                       class="reveal ring-gradient group relative block overflow-hidden rounded-[2rem] glass p-8 transition-transform hover:-translate-y-1 lg:p-12">

                        <div class="grid gap-10 lg:grid-cols-[1.3fr_1fr] lg:items-center">
                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-300">{{ $case['client'] }}</span>
                                    <span class="rounded-full bg-white/8 px-3 py-1 text-xs font-medium text-ink-300">{{ $case['year'] }}</span>
                                    @foreach ($case['domains'] as $domain)
                                        <span class="rounded-full bg-white/8 px-3 py-1 text-xs font-medium text-ink-300">{{ $domain }}</span>
                                    @endforeach
                                </div>

                                <h2 class="mt-6 text-balance text-2xl font-bold text-white lg:text-4xl">
                                    {{ __("site.cases.items.{$slug}.title") }}
                                </h2>
                                <p class="mt-4 max-w-2xl text-pretty leading-relaxed text-ink-300">
                                    {{ __("site.cases.items.{$slug}.short") }}
                                </p>

                                <ul class="mt-6 flex flex-wrap gap-2">
                                    @foreach ($case['services'] as $serviceSlug)
                                        <li class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-ink-300">
                                            {{ __("site.services.items.{$serviceSlug}.title") }}
                                        </li>
                                    @endforeach
                                </ul>

                                <span class="mt-8 inline-flex items-center gap-1.5 text-sm font-semibold text-white">
                                    {{ __('site.common.view_case') }}
                                    <x-ui.icon name="arrow" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
                                </span>
                            </div>

                            <dl class="grid grid-cols-2 gap-px overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                                @foreach ($case['metrics'] as $metric)
                                    <div class="bg-ink-950/60 p-5 text-center">
                                        <dd class="text-3xl font-bold text-gradient">{{ $metric['value'] }}</dd>
                                        <dt class="mt-1 text-xs text-ink-400">{{ __("site.cases.metrics.{$metric['key']}") }}</dt>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.faq :faqs="$seo->faqs" />

    <x-ui.cta />

</x-layouts.site>
