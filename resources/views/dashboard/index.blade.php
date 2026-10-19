<x-layouts.dashboard title="Overview">

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['Licenses', $stats['licenses'], 'shield', 'brand'],
            ['Active', $stats['active'], 'check', 'emerald'],
            ['Site activations', $stats['activations'], 'globe', 'violet'],
            ['New enquiries', $stats['leads'], 'mail', 'amber'],
        ] as [$label, $value, $icon, $accent])
            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-ink-400">{{ $label }}</p>
                    <x-ui.icon :name="$icon" class="h-4 w-4 text-ink-500" />
                </div>
                <p class="mt-3 text-3xl font-bold text-white">{{ number_format($value) }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">

        <section class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-white">Recent licenses</h2>
                <a href="{{ route('dashboard.licenses') }}" class="text-sm text-brand-300 hover:text-brand-200">View all</a>
            </div>

            <ul class="mt-5 divide-y divide-white/8">
                @forelse ($recentLicenses as $license)
                    <li class="flex items-center justify-between gap-4 py-3">
                        <div class="min-w-0">
                            <a href="{{ route('dashboard.licenses.show', $license) }}" class="block truncate font-mono text-sm text-white hover:text-brand-200">{{ $license->key }}</a>
                            <p class="truncate text-xs text-ink-500">{{ $license->customer_email ?? '—' }} · {{ $license->product_slug }}</p>
                        </div>
                        <span @class([
                            'shrink-0 rounded-full px-2.5 py-1 text-xs font-medium',
                            'bg-emerald-400/15 text-emerald-300' => $license->isActive(),
                            'bg-rose-400/15 text-rose-300' => ! $license->isActive(),
                        ])>{{ $license->status }}</span>
                    </li>
                @empty
                    <li class="py-8 text-center text-sm text-ink-500">
                        No licenses yet.
                        <a href="{{ route('dashboard.licenses.create') }}" class="text-brand-300 hover:text-brand-200">Issue the first one</a>.
                    </li>
                @endforelse
            </ul>
        </section>

        <section class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">
            <h2 class="font-semibold text-white">Recent enquiries</h2>

            <ul class="mt-5 divide-y divide-white/8">
                @forelse ($recentLeads as $lead)
                    <li class="py-3">
                        <div class="flex items-center justify-between gap-4">
                            <p class="truncate text-sm font-medium text-white">{{ $lead->name }}</p>
                            <span class="shrink-0 text-xs text-ink-500">{{ $lead->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-0.5 truncate text-xs text-ink-500">{{ $lead->email }} · {{ strtoupper($lead->locale) }}</p>
                        <p class="mt-1.5 line-clamp-2 text-sm text-ink-400">{{ $lead->message }}</p>
                    </li>
                @empty
                    <li class="py-8 text-center text-sm text-ink-500">No enquiries yet.</li>
                @endforelse
            </ul>
        </section>
    </div>

</x-layouts.dashboard>
