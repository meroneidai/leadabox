@props(['name' => 'code', 'class' => 'h-6 w-6'])

@php
    $paths = [
        'code' => '<path d="m8 6-6 6 6 6M16 6l6 6-6 6"/>',
        'sparkles' => '<path d="M12 3v4M12 17v4M3 12h4M17 12h4M5.6 5.6l2.8 2.8M15.6 15.6l2.8 2.8M18.4 5.6l-2.8 2.8M8.4 15.6l-2.8 2.8"/>',
        'device' => '<rect x="7" y="2" width="10" height="20" rx="2.5"/><path d="M11 18.5h2"/>',
        'bot' => '<rect x="4" y="8" width="16" height="12" rx="3"/><path d="M12 8V4M9 14h.01M15 14h.01M2 13v2M22 13v2"/>',
        'plug' => '<path d="M9 2v6M15 2v6M6 8h12v4a6 6 0 0 1-12 0zM12 18v4"/>',
        'headset' => '<path d="M4 14v-2a8 8 0 0 1 16 0v2"/><rect x="2" y="13" width="5" height="7" rx="2"/><rect x="17" y="13" width="5" height="7" rx="2"/><path d="M19 20v1a3 3 0 0 1-3 3h-3"/>',
        'trending' => '<path d="m3 17 6-6 4 4 7-7"/><path d="M15 8h5v5"/>',
        'share' => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.6 13.5 6.8 4M15.4 6.5l-6.8 4"/>',
        'megaphone' => '<path d="m3 11 15-7v16L3 13zM3 11v2a3 3 0 0 0 3 3h1M8 16v4"/>',
        'send' => '<path d="M22 2 11 13M22 2l-7 20-4-9-9-4z"/>',
        'mail' => '<rect x="2" y="5" width="20" height="14" rx="2.5"/><path d="m3 7 9 6 9-6"/>',
        'building' => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M9 8h.01M15 8h.01M9 12h.01M15 12h.01M10 21v-4h4v4"/>',
        'stethoscope' => '<path d="M5 3v6a5 5 0 0 0 10 0V3M5 3H3M15 3h2M10 14v2a5 5 0 0 0 10 0v-1"/><circle cx="20" cy="12" r="2"/>',
        'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2.5"/><path d="M3 10h18M8 3v4M16 3v4"/>',
        'search' => '<circle cx="11" cy="11" r="7"/><path d="m20 20-4.3-4.3"/>',
        'check' => '<path d="m4 12 5 5L20 6"/>',
        'arrow' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'bolt' => '<path d="M13 2 4 14h7l-1 8 9-12h-7z"/>',
        'shield' => '<path d="M12 2 4 6v6c0 5 3.5 8.5 8 10 4.5-1.5 8-5 8-10V6z"/><path d="m9 12 2 2 4-4"/>',
        'globe' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a16 16 0 0 1 0 18M12 3a16 16 0 0 0 0 18"/>',
        'layers' => '<path d="m12 2 9 5-9 5-9-5z"/><path d="m3 12 9 5 9-5M3 17l9 5 9-5"/>',
    ];
@endphp

<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"
     {{ $attributes->merge(['class' => $class]) }}>
    {!! $paths[$name] ?? $paths['code'] !!}
</svg>
