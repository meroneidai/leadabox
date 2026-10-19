<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Log in — Leadabox</title>
    <link rel="icon" href="{{ asset('images/leadabox-mark.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-ink-950 font-sans text-ink-100 antialiased">

<x-site.background />

<div class="relative z-10 flex min-h-screen items-center justify-center px-5 py-16">
    <div class="w-full max-w-md">

        <a href="/" class="mb-8 flex items-center justify-center gap-2.5 text-white">
            <img src="{{ asset('images/leadabox-mark.svg') }}" alt="" width="40" height="40" class="h-10 w-10">
            <span class="text-xl font-bold tracking-tight">Leadabox</span>
        </a>

        <div class="ring-gradient rounded-[1.75rem] glass-strong p-8">
            <h1 class="text-2xl font-bold text-white">Log in</h1>
            <p class="mt-2 text-sm text-ink-400">Manage product licenses and enquiries.</p>

            <form method="POST" action="{{ route('login') }}" class="mt-7 space-y-5">
                @csrf

                <x-form.field name="email" type="email" label="Email" required autocomplete="email" autofocus />
                <x-form.field name="password" type="password" label="Password" required autocomplete="current-password" />

                <label class="flex items-center gap-2.5 text-sm text-ink-300">
                    <input type="checkbox" name="remember" value="1"
                           class="h-4 w-4 rounded border-white/20 bg-white/5 text-brand-500 focus:ring-brand-400">
                    Remember me
                </label>

                <button type="submit"
                        class="w-full rounded-full bg-white px-6 py-3.5 text-base font-semibold text-ink-950 transition-all hover:shadow-[0_0_40px_-8px_rgb(93_140_255/0.9)]">
                    Log in
                </button>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-ink-500">
            <a href="/" class="transition-colors hover:text-white">&larr; Back to leadabox.com</a>
        </p>
    </div>
</div>

</body>
</html>
