<x-layouts.dashboard title="Licenses">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <form method="GET" class="flex flex-1 gap-2 sm:max-w-md">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search key, name or email"
                   class="w-full rounded-xl border border-white/12 bg-white/[0.04] px-4 py-2.5 text-sm text-white placeholder:text-ink-500 focus:border-brand-400/60 focus:outline-none">
            <select name="status" class="rounded-xl border border-white/12 bg-white/[0.04] px-3 py-2.5 text-sm text-white focus:border-brand-400/60 focus:outline-none">
                <option value="" class="bg-ink-900">All</option>
                @foreach (['active', 'suspended', 'revoked'] as $status)
                    <option value="{{ $status }}" @selected(request('status') === $status) class="bg-ink-900">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="shrink-0 rounded-xl border border-white/15 px-4 text-sm font-medium text-white hover:bg-white/5">Filter</button>
        </form>

        <a href="{{ route('dashboard.licenses.create') }}"
           class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-ink-950 hover:bg-brand-100">
            New license
        </a>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl border border-white/10">
        <table class="w-full text-start text-sm">
            <thead class="bg-white/[0.04] text-xs uppercase tracking-wider text-ink-400">
                <tr>
                    <th class="px-5 py-3 text-start font-medium">Key</th>
                    <th class="px-5 py-3 text-start font-medium">Customer</th>
                    <th class="px-5 py-3 text-start font-medium">Product</th>
                    <th class="px-5 py-3 text-start font-medium">Seats</th>
                    <th class="px-5 py-3 text-start font-medium">Status</th>
                    <th class="px-5 py-3 text-start font-medium">Expires</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/8">
                @forelse ($licenses as $license)
                    <tr class="transition-colors hover:bg-white/[0.03]">
                        <td class="px-5 py-3.5">
                            <a href="{{ route('dashboard.licenses.show', $license) }}" class="font-mono text-white hover:text-brand-200">{{ $license->key }}</a>
                        </td>
                        <td class="px-5 py-3.5 text-ink-300">
                            {{ $license->customer_name ?: '—' }}
                            <span class="block text-xs text-ink-500">{{ $license->customer_email }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-ink-300">{{ $license->product_slug }}</td>
                        <td class="px-5 py-3.5 text-ink-300">{{ $license->activations_count }} / {{ $license->seats }}</td>
                        <td class="px-5 py-3.5">
                            <span @class([
                                'rounded-full px-2.5 py-1 text-xs font-medium',
                                'bg-emerald-400/15 text-emerald-300' => $license->isActive(),
                                'bg-amber-400/15 text-amber-300' => $license->status === 'suspended',
                                'bg-rose-400/15 text-rose-300' => $license->status === 'revoked' || $license->isExpired(),
                            ])>{{ $license->isExpired() ? 'expired' : $license->status }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-ink-400">{{ $license->expires_at?->format('Y-m-d') ?? 'Never' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-12 text-center text-ink-500">No licenses found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $licenses->links() }}</div>

</x-layouts.dashboard>
