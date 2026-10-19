@php use App\Support\Locales; @endphp

<x-layouts.site :seo="$seo">

    {{-- ===================== HERO ===================== --}}
    <section data-stage class="stage-3d relative overflow-hidden pt-32 pb-20 sm:pt-40 lg:pt-44 lg:pb-28">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="grid items-center gap-16 lg:grid-cols-[1.05fr_0.95fr] lg:gap-10">

                {{-- Copy --}}
                <div class="stage-3d__layer relative z-20" data-depth="0.25" data-z="60">
                    <p class="reveal inline-flex items-center gap-2 rounded-full border border-brand-400/30 bg-brand-500/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.14em] text-brand-200">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-brand-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-brand-400"></span>
                        </span>
                        {{ __('site.home.eyebrow') }}
                    </p>

                    <h1 class="reveal mt-7 text-balance text-4xl font-extrabold leading-[1.08] tracking-tight text-white sm:text-5xl lg:text-6xl xl:text-[4.25rem]" data-reveal-delay="80">
                        {{ __('site.home.title') }}
                    </h1>

                    <p class="reveal mt-7 max-w-xl text-pretty text-lg leading-relaxed text-ink-300 sm:text-xl" data-reveal-delay="160">
                        {{ __('site.home.subtitle') }}
                    </p>

                    <div class="reveal mt-10 flex flex-col gap-3 sm:flex-row" data-reveal-delay="240">
                        <a href="{{ Locales::route('contact') }}"
                           class="group inline-flex items-center justify-center gap-2 rounded-full bg-white px-7 py-4 text-base font-semibold text-ink-950 transition-all hover:shadow-[0_0_44px_-8px_rgb(93_140_255/0.9)]">
                            {{ __('site.home.cta_primary') }}
                            <x-ui.icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
                        </a>
                        <a href="{{ Locales::route('cases') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-full border border-white/20 px-7 py-4 text-base font-semibold text-white transition-colors hover:bg-white/5">
                            {{ __('site.home.cta_secondary') }}
                        </a>
                    </div>

                    <ul class="reveal mt-12 grid gap-x-8 gap-y-3 sm:grid-cols-2" data-reveal-delay="320">
                        @foreach (__('site.home.trust.items') as $item)
                            <li class="flex items-start gap-2.5 text-sm text-ink-300">
                                <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-brand-500/20 text-brand-300">
                                    <x-ui.icon name="check" class="h-3 w-3" />
                                </span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- 3D visual --}}
                <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
                    <div class="relative aspect-square">

                        <div class="stage-3d__layer absolute inset-0 flex items-center justify-center" data-depth="0.55" data-z="-120">
                            <div class="h-[78%] w-[78%] rounded-full opacity-70 blur-[70px]"
                                 style="background: conic-gradient(from 180deg, #2d6cff, #7b2dff, #22d3ee, #2d6cff);"></div>
                        </div>

                        {{-- Main dashboard card --}}
                        <div class="stage-3d__layer absolute inset-x-0 top-1/2 -translate-y-1/2" data-depth="0.9" data-z="40">
                            <div class="ring-gradient glass-strong rounded-[1.75rem] p-5 shadow-2xl">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="h-2.5 w-2.5 rounded-full bg-rose-400/80"></span>
                                        <span class="h-2.5 w-2.5 rounded-full bg-amber-400/80"></span>
                                        <span class="h-2.5 w-2.5 rounded-full bg-emerald-400/80"></span>
                                    </div>
                                    <span class="text-[10px] font-medium uppercase tracking-widest text-ink-400">Core Web Vitals</span>
                                </div>

                                <div class="mt-5 grid grid-cols-3 gap-3">
                                    @foreach ([['LCP', '1.2s'], ['INP', '84ms'], ['CLS', '0.01']] as [$metric, $value])
                                        <div class="rounded-xl border border-emerald-400/20 bg-emerald-400/[0.07] p-3">
                                            <p class="text-[10px] font-semibold uppercase tracking-wider text-emerald-300/80">{{ $metric }}</p>
                                            <p class="mt-1 text-xl font-bold text-white">{{ $value }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-4 space-y-2.5">
                                    @foreach ([['w-[92%]', 'from-brand-400 to-brand-600'], ['w-[76%]', 'from-violet-400 to-violet-600'], ['w-[58%]', 'from-cyan-400 to-cyan-600']] as [$w, $grad])
                                        <div class="h-2 overflow-hidden rounded-full bg-white/5">
                                            <div class="h-full {{ $w }} rounded-full bg-gradient-to-r {{ $grad }}"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Floating AI agent chip --}}
                        <div class="stage-3d__layer absolute -top-2 end-0 w-52 animate-float" data-depth="1.5" data-z="110">
                            <div class="glass-strong rounded-2xl p-4 shadow-xl">
                                <div class="flex items-center gap-2.5">
                                    <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-brand-400 to-violet-500 text-white">
                                        <x-ui.icon name="bot" class="h-4 w-4" />
                                    </span>
                                    <div class="min-w-0">
                                        <p class="truncate text-xs font-semibold text-white">AI Agent</p>
                                        <p class="truncate text-[10px] text-emerald-300">● Online 24/7</p>
                                    </div>
                                </div>
                                <p class="mt-3 rounded-lg bg-white/5 p-2.5 text-[11px] leading-relaxed text-ink-200">
                                    “Your appointment is booked for Tuesday 14:30.”
                                </p>
                            </div>
                        </div>

                        {{-- Floating language chip --}}
                        <div class="stage-3d__layer absolute bottom-4 start-0 w-44 animate-float-slow" data-depth="1.25" data-z="90">
                            <div class="glass-strong rounded-2xl p-4 shadow-xl">
                                <div class="flex items-center gap-2 text-white">
                                    <x-ui.icon name="globe" class="h-4 w-4 text-cyan-300" />
                                    <p class="text-xs font-semibold">5 languages</p>
                                </div>
                                <div class="mt-2.5 flex flex-wrap gap-1">
                                    @foreach (config('site.locales') as $meta)
                                        <span class="rounded-md bg-white/8 px-1.5 py-0.5 text-[10px] font-medium text-ink-200">{{ strtoupper($meta['prefix'] ?? 'EN') }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Floating speed badge --}}
                        <div class="stage-3d__layer absolute -bottom-3 end-6 animate-float" data-depth="1.7" data-z="140" style="animation-delay:-3s">
                            <div class="flex items-center gap-2 rounded-full bg-gradient-to-r from-brand-500 to-violet-500 px-4 py-2.5 shadow-lg shadow-brand-500/30">
                                <x-ui.icon name="bolt" class="h-4 w-4 text-white" />
                                <span class="text-xs font-bold text-white">98 / 100</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <dl class="mt-20 grid grid-cols-2 gap-px overflow-hidden rounded-3xl border border-white/10 bg-white/5 lg:mt-28 lg:grid-cols-4">
                @foreach (__('site.home.stats') as $i => $stat)
                    <div class="reveal bg-ink-950/60 p-6 text-center lg:p-8" data-reveal-delay="{{ $i * 70 }}">
                        <dt class="order-2 mt-2 text-sm text-ink-400">{{ $stat['label'] }}</dt>
                        <dd class="order-1 text-3xl font-bold text-white lg:text-4xl">
                            <span class="text-gradient">{{ $stat['value'] }}</span>
                        </dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    {{-- ===================== SERVICES ===================== --}}
    <section class="relative py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <x-ui.section-heading
                :eyebrow="__('site.home.services.eyebrow')"
                :title="__('site.home.services.title')"
                :body="__('site.home.services.body')"
            />

            <div class="mt-16 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $slug => $service)
                    <a href="{{ Locales::route('service', ['service' => $slug]) }}"
                       class="reveal group relative overflow-hidden rounded-[1.5rem] border border-white/10 bg-white/[0.03] p-7 transition-all duration-300 hover:-translate-y-1 hover:border-white/25 hover:bg-white/[0.06] {{ $loop->first ? 'sm:col-span-2 lg:col-span-1' : '' }}"
                       data-reveal-delay="{{ $loop->index * 70 }}">
                        <div class="pointer-events-none absolute -end-16 -top-16 h-40 w-40 rounded-full opacity-0 blur-3xl transition-opacity duration-500 group-hover:opacity-60"
                             style="background: radial-gradient(circle, #2d6cff, transparent 70%);"></div>

                        <span class="relative flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-400/25 to-violet-500/25 text-brand-200 ring-1 ring-inset ring-white/10">
                            <x-ui.icon :name="$service['icon']" class="h-5 w-5" />
                        </span>

                        <h3 class="relative mt-6 text-xl font-semibold text-white">
                            {{ __("site.services.items.{$slug}.title") }}
                        </h3>
                        <p class="relative mt-3 text-pretty leading-relaxed text-ink-400">
                            {{ __("site.services.items.{$slug}.short") }}
                        </p>

                        <span class="relative mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-300">
                            {{ __('site.common.learn_more') }}
                            <x-ui.icon name="arrow" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== AI AGENTS ===================== --}}
    <section class="relative py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="grid gap-14 lg:grid-cols-[0.9fr_1.1fr] lg:items-center lg:gap-20">
                <x-ui.section-heading
                    :eyebrow="__('site.home.agents.eyebrow')"
                    :title="__('site.home.agents.title')"
                    :body="__('site.home.agents.body')"
                >
                    <a href="{{ Locales::route('agents') }}"
                       class="reveal mt-9 inline-flex items-center gap-2 rounded-full border border-white/20 px-6 py-3.5 text-sm font-semibold text-white transition-colors hover:bg-white/5"
                       data-reveal-delay="180">
                        {{ __('site.common.view_all') }}
                        <x-ui.icon name="arrow" class="h-4 w-4 rtl:rotate-180" />
                    </a>
                </x-ui.section-heading>

                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach (array_slice($agents, 0, 6, true) as $slug => $agent)
                        <a href="{{ Locales::route('agents') }}#{{ $slug }}"
                           class="reveal group rounded-2xl border border-white/10 bg-white/[0.03] p-5 transition-all hover:border-brand-400/40 hover:bg-brand-500/[0.07]"
                           data-reveal-delay="{{ $loop->index * 60 }}">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/5 text-brand-200 ring-1 ring-inset ring-white/10 transition-colors group-hover:text-white">
                                <x-ui.icon :name="$agent['icon']" class="h-4.5 w-4.5" />
                            </span>
                            <h3 class="mt-4 text-sm font-semibold text-white">{{ __("site.agents.items.{$slug}.title") }}</h3>
                            <p class="mt-1.5 text-sm leading-relaxed text-ink-400">{{ __("site.agents.items.{$slug}.short") }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== PLATFORMS MARQUEE ===================== --}}
    <section class="relative py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <x-ui.section-heading
                align="center"
                :eyebrow="__('site.home.platforms.eyebrow')"
                :title="__('site.home.platforms.title')"
                :body="__('site.home.platforms.body')"
            />
        </div>

        <div class="marquee mask-fade-x mt-14 overflow-hidden">
            <div class="marquee-track flex w-max gap-3">
                @foreach (array_merge($platforms, $platforms) as $key => $platform)
                    <span class="flex items-center gap-2.5 whitespace-nowrap rounded-2xl border border-white/10 bg-white/[0.04] px-6 py-4 text-sm font-semibold text-ink-200">
                        <x-ui.icon name="layers" class="h-4 w-4 text-brand-300" />
                        {{ $platform['name'] }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== PROCESS ===================== --}}
    <section class="relative py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <x-ui.section-heading
                :eyebrow="__('site.home.process.eyebrow')"
                :title="__('site.home.process.title')"
                :body="__('site.home.process.body')"
            />

            <ol class="mt-16 grid gap-5 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($process as $i => $step)
                    <li class="reveal relative rounded-2xl border border-white/10 bg-white/[0.03] p-6" data-reveal-delay="{{ $i * 70 }}">
                        <span class="text-5xl font-bold leading-none text-white/8">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-4 text-base font-semibold text-white">{{ __("site.process_copy.{$step}.title") }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-400">{{ __("site.process_copy.{$step}.body") }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ===================== CASE + PRODUCT ===================== --}}
    <section class="relative py-24 lg:py-28">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="grid gap-5 lg:grid-cols-2">

                @foreach ($cases as $slug => $case)
                    <a href="{{ Locales::route('case', ['case' => $slug]) }}"
                       class="reveal ring-gradient group relative overflow-hidden rounded-[1.75rem] glass p-8 transition-transform hover:-translate-y-1 lg:p-10">
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-emerald-300">{{ __('site.cases.eyebrow') }}</p>
                        <h3 class="mt-4 text-2xl font-bold text-white lg:text-3xl">{{ __("site.cases.items.{$slug}.title") }}</h3>
                        <p class="mt-4 text-pretty leading-relaxed text-ink-300">{{ __("site.cases.items.{$slug}.short") }}</p>

                        <dl class="mt-8 grid grid-cols-4 gap-3">
                            @foreach ($case['metrics'] as $metric)
                                <div>
                                    <dd class="text-2xl font-bold text-white">{{ $metric['value'] }}</dd>
                                </div>
                            @endforeach
                        </dl>

                        <span class="mt-8 inline-flex items-center gap-1.5 text-sm font-semibold text-white">
                            {{ __('site.common.view_case') }}
                            <x-ui.icon name="arrow" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
                        </span>
                    </a>
                @endforeach

                @foreach ($products as $slug => $product)
                    <a href="{{ Locales::route('product', ['product' => $slug]) }}"
                       class="reveal group relative overflow-hidden rounded-[1.75rem] border border-white/10 bg-white/[0.03] p-8 transition-all hover:-translate-y-1 hover:border-white/25 lg:p-10"
                       data-reveal-delay="100">
                        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-brand-300">{{ __('site.products.eyebrow') }}</p>
                        <h3 class="mt-4 text-2xl font-bold text-white lg:text-3xl">{{ $product['name'] }}</h3>
                        <p class="mt-2 text-lg font-medium text-brand-200">{{ __("site.products.items.{$slug}.tagline") }}</p>
                        <p class="mt-4 text-pretty leading-relaxed text-ink-300">{{ __("site.products.items.{$slug}.description") }}</p>

                        <div class="mt-8 flex flex-wrap gap-2">
                            <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-300">{{ __('site.products.free_badge') }}</span>
                            <span class="rounded-full bg-white/8 px-3 py-1 text-xs font-medium text-ink-300">{{ $product['category'] }}</span>
                            <span class="rounded-full bg-white/8 px-3 py-1 text-xs font-medium text-ink-300">v{{ $product['version'] }}</span>
                        </div>

                        <span class="mt-8 inline-flex items-center gap-1.5 text-sm font-semibold text-white">
                            {{ __('site.common.learn_more') }}
                            <x-ui.icon name="arrow" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.faq :faqs="$seo->faqs" />

    <x-ui.cta />

</x-layouts.site>
