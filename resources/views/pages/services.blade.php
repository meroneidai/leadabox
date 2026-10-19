@php use App\Support\Locales; @endphp

<x-layouts.site :seo="$seo">

    <x-ui.page-hero
        :crumbs="$seo->breadcrumbs"
        :eyebrow="__('site.services.eyebrow')"
        :title="__('site.services.hero_title')"
        :body="__('site.services.hero_body')"
    />

    <section class="relative pb-8">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="space-y-5">
                @foreach ($services as $slug => $service)
                    <a href="{{ Locales::route('service', ['service' => $slug]) }}"
                       class="reveal group relative block overflow-hidden rounded-[1.75rem] border border-white/10 bg-white/[0.03] p-7 transition-all duration-300 hover:border-white/25 hover:bg-white/[0.06] lg:p-10"
                       data-reveal-delay="{{ $loop->index * 70 }}">

                        <div class="pointer-events-none absolute -end-20 -top-20 h-64 w-64 rounded-full opacity-0 blur-3xl transition-opacity duration-500 group-hover:opacity-50"
                             style="background: radial-gradient(circle, #2d6cff, transparent 70%);"></div>

                        <div class="relative grid gap-8 lg:grid-cols-[auto_1fr_auto] lg:items-center">
                            <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-400/25 to-violet-500/25 text-brand-200 ring-1 ring-inset ring-white/10">
                                <x-ui.icon :name="$service['icon']" class="h-6 w-6" />
                            </span>

                            <div>
                                <h2 class="text-2xl font-bold text-white lg:text-3xl">
                                    {{ __("site.services.items.{$slug}.title") }}
                                </h2>
                                <p class="mt-3 max-w-2xl text-pretty leading-relaxed text-ink-300">
                                    {{ __("site.services.items.{$slug}.short") }}
                                </p>
                                <ul class="mt-5 flex flex-wrap gap-2">
                                    @foreach (array_slice($service['stack'], 0, 6) as $tech)
                                        <li class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-medium text-ink-300">{{ $tech }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-full border border-white/15 text-white transition-all group-hover:border-brand-400/60 group-hover:bg-brand-500/20">
                                <x-ui.icon name="arrow" class="h-4 w-4 rtl:rotate-180" />
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.faq :faqs="$seo->faqs" />

    <x-ui.cta />

</x-layouts.site>
