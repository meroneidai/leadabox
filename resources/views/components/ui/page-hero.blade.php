@props([
    'eyebrow' => null,
    'title' => null,
    'body' => null,
    'crumbs' => [],
])

<section class="relative overflow-hidden">
    <x-ui.breadcrumbs :crumbs="$crumbs" />

    <div class="mx-auto max-w-7xl px-5 pb-16 pt-10 sm:px-8 lg:pb-24 lg:pt-14">
        <div class="max-w-4xl">
            @if ($eyebrow)
                <p class="reveal inline-flex items-center gap-2 rounded-full border border-brand-400/30 bg-brand-500/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.14em] text-brand-200">
                    <span class="h-1.5 w-1.5 rounded-full bg-brand-400"></span>
                    {{ $eyebrow }}
                </p>
            @endif

            <h1 class="reveal mt-6 text-balance text-4xl font-extrabold leading-[1.1] tracking-tight text-white sm:text-5xl lg:text-6xl" data-reveal-delay="80">
                {{ $title }}
            </h1>

            @if ($body)
                <p class="reveal mt-7 max-w-2xl text-pretty text-lg leading-relaxed text-ink-300 sm:text-xl" data-reveal-delay="160">
                    {{ $body }}
                </p>
            @endif

            {{ $slot }}
        </div>
    </div>
</section>
