@props([
    'name',
    'label',
    'type' => 'text',
    'required' => false,
    'placeholder' => null,
])

@php $id = $attributes->get('id', $name); @endphp

<div @class(['sm:col-span-2' => $type === 'textarea'])>
    <label for="{{ $id }}" class="block text-sm font-medium text-ink-200">
        {{ $label }}
        @if ($required)<span class="text-brand-300" aria-hidden="true">*</span>@endif
    </label>

    @if ($type === 'textarea')
        <textarea
            name="{{ $name }}"
            id="{{ $id }}"
            rows="5"
            @required($required)
            placeholder="{{ $placeholder }}"
            @if ($errors->has($name)) aria-invalid="true" aria-describedby="{{ $id }}-error" @endif
            {{ $attributes->merge(['class' => 'mt-2 block w-full rounded-xl border bg-white/[0.04] px-4 py-3 text-white placeholder:text-ink-500 transition-colors focus:bg-white/[0.07] focus:outline-none ' . ($errors->has($name) ? 'border-rose-400/60' : 'border-white/12 focus:border-brand-400/60')]) }}
        >{{ old($name) }}</textarea>
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ old($name) }}"
            @required($required)
            placeholder="{{ $placeholder }}"
            @if ($errors->has($name)) aria-invalid="true" aria-describedby="{{ $id }}-error" @endif
            {{ $attributes->merge(['class' => 'mt-2 block w-full rounded-xl border bg-white/[0.04] px-4 py-3 text-white placeholder:text-ink-500 transition-colors focus:bg-white/[0.07] focus:outline-none ' . ($errors->has($name) ? 'border-rose-400/60' : 'border-white/12 focus:border-brand-400/60')]) }}
        >
    @endif

    @error($name)
        <p id="{{ $id }}-error" class="mt-1.5 text-sm text-rose-300">{{ $message }}</p>
    @enderror
</div>
