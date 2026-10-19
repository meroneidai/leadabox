@php
    use App\Support\Locales;

    $locale = Locales::current();
    $meta = Locales::meta($locale);
    $company = config('site.company');
    $seo = $seo ?? \App\Support\Seo::make()->title(config('site.company.name'));
@endphp
<!DOCTYPE html>
<html lang="{{ $meta['hreflang'] }}" dir="{{ $meta['dir'] }}" class="scroll-pt-24">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0b0e1f">

    <title>{{ $seo->fullTitle() }}</title>
    <meta name="description" content="{{ $seo->description }}">
    @if ($seo->keywords)
        <meta name="keywords" content="{{ implode(', ', $seo->keywords) }}">
    @endif
    <meta name="robots" content="{{ $seo->noindex ? 'noindex, nofollow' : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' }}">
    <meta name="author" content="{{ $company['name'] }}">

    <link rel="canonical" href="{{ $seo->canonical ?: url()->current() }}">

    {{-- hreflang: every locale plus x-default pointing at the root language --}}
    @foreach (Locales::all() as $code => $alt)
        <link rel="alternate" hreflang="{{ $alt['hreflang'] }}" href="{{ Locales::alternate($code) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ Locales::alternate(Locales::default()) }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $seo->type }}">
    <meta property="og:site_name" content="{{ $company['name'] }}">
    <meta property="og:title" content="{{ $seo->fullTitle() }}">
    <meta property="og:description" content="{{ $seo->description }}">
    <meta property="og:url" content="{{ $seo->canonical ?: url()->current() }}">
    <meta property="og:locale" content="{{ $meta['locale'] }}">
    @foreach (Locales::all() as $code => $alt)
        @if ($code !== $locale)
            <meta property="og:locale:alternate" content="{{ $alt['locale'] }}">
        @endif
    @endforeach
    <meta property="og:image" content="{{ $seo->ogImage() }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    @if ($seo->imageAlt)
        <meta property="og:image:alt" content="{{ $seo->imageAlt }}">
    @endif
    @if ($seo->publishedAt)
        <meta property="article:published_time" content="{{ $seo->publishedAt }}">
        <meta property="article:modified_time" content="{{ $seo->modifiedAt }}">
    @endif

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo->fullTitle() }}">
    <meta name="twitter:description" content="{{ $seo->description }}">
    <meta name="twitter:image" content="{{ $seo->ogImage() }}">

    <link rel="icon" href="{{ asset('images/leadabox-mark.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/leadabox-mark.svg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800{{ Locales::isRtl() ? '|tajawal:400,500,700,800' : '' }}&display=swap" rel="stylesheet">

    <script type="application/ld+json">{!! $seo->jsonLd() !!}</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-ink-950 font-sans antialiased selection:bg-brand-500/90">

    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:start-4 focus:z-[100] focus:rounded-xl focus:bg-brand-500 focus:px-5 focus:py-3 focus:text-sm focus:font-semibold focus:text-white">
        {{ __('site.nav.skip') }}
    </a>

    <x-site.background />

    <x-site.header />

    <main id="main" class="relative z-10">
        {{ $slot }}
    </main>

    <x-site.footer />

</body>
</html>
