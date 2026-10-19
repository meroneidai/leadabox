<x-layouts.dashboard title="New license">

    <form method="POST" action="{{ route('dashboard.licenses.store') }}" class="max-w-2xl space-y-5 rounded-2xl border border-white/10 bg-white/[0.03] p-7">
        @csrf

        <div class="grid gap-5 sm:grid-cols-2">
            <x-form.select name="product_slug" label="Product">
                @foreach ($products as $slug => $product)
                    <option value="{{ $slug }}" @selected(old('product_slug') === $slug) class="bg-ink-900">{{ $product['name'] }}</option>
                @endforeach
            </x-form.select>

            <x-form.select name="plan" label="Plan">
                @foreach (['pro' => 'Pro', 'agency' => 'Agency', 'lifetime' => 'Lifetime'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('plan') === $value) class="bg-ink-900">{{ $label }}</option>
                @endforeach
            </x-form.select>

            <x-form.field name="customer_name" label="Customer name" />
            <x-form.field name="customer_email" type="email" label="Customer email" required />
            <x-form.field name="seats" type="number" label="Seats" required value="1" min="1" max="1000" />
            <x-form.field name="expires_at" type="date" label="Expires (blank = never)" />
        </div>

        <x-form.field name="notes" type="textarea" label="Internal notes" />

        <div class="flex gap-3">
            <button type="submit" class="rounded-xl bg-white px-6 py-3 text-sm font-semibold text-ink-950 hover:bg-brand-100">
                Issue license
            </button>
            <a href="{{ route('dashboard.licenses') }}" class="rounded-xl border border-white/15 px-6 py-3 text-sm font-medium text-white hover:bg-white/5">
                Cancel
            </a>
        </div>
    </form>

</x-layouts.dashboard>
