<x-layouts.dashboard :title="$license->key">

    <div class="grid gap-6 lg:grid-cols-[1.4fr_1fr]">

        <div class="space-y-6">
            <section class="rounded-2xl border border-white/10 bg-white/[0.03] p-7">
                <p class="text-xs uppercase tracking-wider text-ink-400">License key</p>
                <p class="mt-2 break-all font-mono text-xl text-white">{{ $license->key }}</p>

                <dl class="mt-6 grid grid-cols-2 gap-5 text-sm sm:grid-cols-4">
                    @foreach ([
                        ['Product', $license->product_slug],
                        ['Plan', ucfirst($license->plan)],
                        ['Seats used', $license->seats - $license->seatsRemaining().' / '.$license->seats],
                        ['Expires', $license->expires_at?->format('Y-m-d') ?? 'Never'],
                    ] as [$label, $value])
                        <div>
                            <dt class="text-ink-500">{{ $label }}</dt>
                            <dd class="mt-1 font-medium text-white">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </section>

            <section class="rounded-2xl border border-white/10 bg-white/[0.03] p-7">
                <h2 class="font-semibold text-white">Site activations</h2>

                <ul class="mt-5 divide-y divide-white/8">
                    @forelse ($license->activations as $activation)
                        <li class="flex items-center justify-between gap-4 py-3.5">
                            <div class="min-w-0">
                                <p class="truncate font-medium text-white">{{ $activation->site_url }}</p>
                                <p class="text-xs text-ink-500">
                                    v{{ $activation->product_version ?? '?' }} ·
                                    last seen {{ $activation->last_seen_at?->diffForHumans() ?? 'never' }}
                                    @if (! $activation->isActive()) · <span class="text-rose-300">released</span> @endif
                                </p>
                            </div>

                            @if ($activation->isActive())
                                <form method="POST" action="{{ route('dashboard.licenses.deactivate', [$license, $activation]) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="shrink-0 rounded-lg border border-rose-400/40 px-3 py-1.5 text-xs font-medium text-rose-300 hover:bg-rose-400/10">
                                        Release seat
                                    </button>
                                </form>
                            @endif
                        </li>
                    @empty
                        <li class="py-8 text-center text-sm text-ink-500">Not activated on any site yet.</li>
                    @endforelse
                </ul>
            </section>
        </div>

        <form method="POST" action="{{ route('dashboard.licenses.update', $license) }}"
              class="h-fit space-y-5 rounded-2xl border border-white/10 bg-white/[0.03] p-7">
            @csrf @method('PATCH')

            <h2 class="font-semibold text-white">Manage</h2>

            <x-form.select name="status" label="Status">
                @foreach (['active', 'suspended', 'revoked'] as $status)
                    <option value="{{ $status }}" @selected($license->status === $status) class="bg-ink-900">{{ ucfirst($status) }}</option>
                @endforeach
            </x-form.select>

            <x-form.field name="seats" type="number" label="Seats" required :value="$license->seats" min="1" max="1000" />
            <x-form.field name="expires_at" type="date" label="Expires" :value="$license->expires_at?->format('Y-m-d')" />
            <x-form.field name="notes" type="textarea" label="Notes" :value="$license->notes" />

            <button type="submit" class="w-full rounded-xl bg-white px-6 py-3 text-sm font-semibold text-ink-950 hover:bg-brand-100">
                Save changes
            </button>
        </form>
    </div>

</x-layouts.dashboard>
