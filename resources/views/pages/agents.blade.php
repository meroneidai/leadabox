@php use App\Support\Locales; @endphp

<x-layouts.site :seo="$seo">

    <x-ui.page-hero
        :crumbs="$seo->breadcrumbs"
        :eyebrow="__('site.agents.eyebrow')"
        :title="__('site.agents.hero_title')"
        :body="__('site.agents.hero_body')"
    >
        <div class="reveal mt-10" data-reveal-delay="240">
            <a href="{{ Locales::route('contact') }}"
               class="group inline-flex items-center justify-center gap-2 rounded-full bg-white px-7 py-4 text-base font-semibold text-ink-950 transition-all hover:shadow-[0_0_40px_-8px_rgb(93_140_255/0.9)]">
                {{ __('site.common.talk_to_us') }}
                <x-ui.icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
            </a>
        </div>
    </x-ui.page-hero>

    <section class="relative py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <x-ui.section-heading
                :title="__('site.agents.intro_title')"
                :body="__('site.agents.intro_body')"
            />

            <div class="mt-16 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($agents as $slug => $agent)
                    <article id="{{ $slug }}"
                             class="reveal group relative scroll-mt-28 overflow-hidden rounded-[1.5rem] border border-white/10 bg-white/[0.03] p-7 transition-all duration-300 hover:-translate-y-1 hover:border-white/25 hover:bg-white/[0.06]"
                             data-reveal-delay="{{ ($loop->index % 3) * 70 }}">

                        <div class="pointer-events-none absolute -end-16 -top-16 h-40 w-40 rounded-full opacity-0 blur-3xl transition-opacity duration-500 group-hover:opacity-60"
                             style="background: radial-gradient(circle, #7b2dff, transparent 70%);"></div>

                        <span class="relative flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-400/25 to-violet-500/25 text-brand-200 ring-1 ring-inset ring-white/10">
                            <x-ui.icon :name="$agent['icon']" class="h-5 w-5" />
                        </span>

                        <h3 class="relative mt-6 text-lg font-semibold text-white">{{ __("site.agents.items.{$slug}.title") }}</h3>
                        <p class="relative mt-3 text-sm leading-relaxed text-ink-300">{{ __("site.agents.items.{$slug}.short") }}</p>
                        <p class="relative mt-3 text-sm leading-relaxed text-ink-400">{{ __("site.agents.items.{$slug}.body") }}</p>

                        <p class="relative mt-6 inline-flex items-center gap-2 rounded-full bg-white/5 px-3 py-1.5 text-xs font-medium text-ink-300">
                            <x-ui.icon name="bolt" class="h-3 w-3 text-amber-300" />
                            {{ __("site.agents.items.{$slug}.replaces") }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.faq :faqs="$seo->faqs" />

    <x-ui.cta />

</x-layouts.site>
