@props(['inline' => false])

@php
    use App\Support\Locales;

    $current = Locales::current();
    $currentMeta = Locales::meta($current);
@endphp

@if ($inline)
    <div {{ $attributes->merge(['class' => 'flex flex-wrap gap-2']) }}>
        @foreach (Locales::all() as $code => $meta)
            <a href="{{ Locales::alternate($code) }}" hreflang="{{ $meta['hreflang'] }}" lang="{{ $meta['hreflang'] }}"
               @class([
                   'rounded-full border px-4 py-2 text-sm font-medium transition-colors',
                   'border-brand-400/60 bg-brand-500/15 text-white' => $code === $current,
                   'border-white/12 text-ink-300 hover:border-white/25 hover:text-white' => $code !== $current,
               ])>
                {{ $meta['native'] }}
            </a>
        @endforeach
    </div>
@else
    <div data-lang-switch {{ $attributes->merge(['class' => 'relative']) }}>
        <button type="button" data-lang-button aria-expanded="false" aria-haspopup="true"
                class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-3.5 py-2 text-sm font-medium text-ink-200 transition-colors hover:text-white">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4">
                <circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a16 16 0 0 1 0 18M12 3a16 16 0 0 0 0 18"/>
            </svg>
            <span>{{ $currentMeta['native'] }}</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5 opacity-60">
                <path d="M6 9l6 6 6-6"/>
            </svg>
        </button>

        <ul data-lang-list hidden
            class="absolute end-0 top-full z-50 mt-2 w-52 overflow-hidden rounded-2xl border border-white/12 bg-ink-900/95 p-1.5 shadow-2xl backdrop-blur-xl">
            @foreach (Locales::all() as $code => $meta)
                <li>
                    <a href="{{ Locales::alternate($code) }}" hreflang="{{ $meta['hreflang'] }}" lang="{{ $meta['hreflang'] }}"
                       @class([
                           'flex items-center justify-between gap-3 rounded-xl px-3.5 py-2.5 text-sm transition-colors',
                           'bg-brand-500/20 text-white' => $code === $current,
                           'text-ink-300 hover:bg-white/5 hover:text-white' => $code !== $current,
                       ])>
                        <span class="font-medium">{{ $meta['native'] }}</span>
                        <span class="text-xs text-ink-500">{{ $meta['region'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
