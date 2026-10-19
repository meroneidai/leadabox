@props([
    'eyebrow' => null,
    'title' => null,
    'body' => null,
    'align' => 'start',
    'as' => 'h2',
])

<div @class([
    'max-w-3xl',
    'mx-auto text-center' => $align === 'center',
])>
    @if ($eyebrow)
        <p class="reveal inline-flex items-center gap-2 rounded-full border border-brand-400/30 bg-brand-500/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.14em] text-brand-200">
            <span class="h-1.5 w-1.5 rounded-full bg-brand-400"></span>
            {{ $eyebrow }}
        </p>
    @endif

    @if ($title)
        <{{ $as }} class="reveal mt-5 text-balance text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-[2.75rem] lg:leading-[1.1]" data-reveal-delay="60">
            {{ $title }}
        </{{ $as }}>
    @endif

    @if ($body)
        <p class="reveal mt-5 text-pretty text-lg leading-relaxed text-ink-300" data-reveal-delay="120">
            {{ $body }}
        </p>
    @endif

    {{ $slot }}
</div>
