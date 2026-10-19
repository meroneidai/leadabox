@props(['name', 'label', 'placeholder' => null])

@php $id = $attributes->get('id', $name); @endphp

<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-ink-200">{{ $label }}</label>

    <select
        name="{{ $name }}"
        id="{{ $id }}"
        {{ $attributes->merge(['class' => 'mt-2 block w-full appearance-none rounded-xl border border-white/12 bg-white/[0.04] px-4 py-3 text-white transition-colors focus:border-brand-400/60 focus:bg-white/[0.07] focus:outline-none']) }}
    >
        @if ($placeholder)
            <option value="" class="bg-ink-900">{{ $placeholder }}</option>
        @endif
        {{ $slot }}
    </select>

    @error($name)
        <p class="mt-1.5 text-sm text-rose-300">{{ $message }}</p>
    @enderror
</div>
