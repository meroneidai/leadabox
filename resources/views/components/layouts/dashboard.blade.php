@props(['title' => null])

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title ? $title.' — ' : '' }}Leadabox Dashboard</title>
    <link rel="icon" href="{{ asset('images/leadabox-mark.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-ink-950 font-sans text-ink-100 antialiased">

<div class="flex min-h-screen">

    <aside class="hidden w-64 shrink-0 border-e border-white/8 bg-ink-950/80 lg:block">
        <div class="flex h-16 items-center gap-2.5 border-b border-white/8 px-6">
            <img src="{{ asset('images/leadabox-mark.svg') }}" alt="" width="28" height="28" class="h-7 w-7">
            <span class="font-bold text-white">Leadabox</span>
        </div>

        <nav class="p-4">
            <ul class="space-y-1">
                @foreach ([
                    ['dashboard.index', 'Overview', 'layers'],
                    ['dashboard.licenses', 'Licenses', 'shield'],
                ] as [$route, $label, $icon])
                    <li>
                        <a href="{{ route($route) }}"
                           @class([
                               'flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-sm font-medium transition-colors',
                               'bg-brand-500/15 text-white' => request()->routeIs($route),
                               'text-ink-400 hover:bg-white/5 hover:text-white' => ! request()->routeIs($route),
                           ])>
                            <x-ui.icon :name="$icon" class="h-4 w-4" />
                            {{ $label }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </aside>

    <div class="flex min-w-0 flex-1 flex-col">
        <header class="flex h-16 items-center justify-between gap-4 border-b border-white/8 px-5 sm:px-8">
            <h1 class="truncate text-lg font-semibold text-white">{{ $title ?? 'Dashboard' }}</h1>

            <div class="flex items-center gap-3">
                <a href="/" class="text-sm text-ink-400 transition-colors hover:text-white">View site</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-full border border-white/15 px-4 py-1.5 text-sm font-medium text-ink-200 transition-colors hover:bg-white/5 hover:text-white">
                        Log out
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-5 sm:p-8">
            @if (session('status'))
                <div class="mb-6 rounded-xl border border-emerald-400/30 bg-emerald-400/10 px-5 py-3.5 text-sm text-emerald-100">
                    {{ session('status') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</div>

</body>
</html>
