@php use App\Support\Locales; @endphp

<x-layouts.site :seo="$seo">

    <x-ui.page-hero
        :crumbs="$seo->breadcrumbs"
        :eyebrow="__('site.products.eyebrow')"
        :title="__('site.products.hero_title')"
        :body="__('site.products.hero_body')"
    />

    <section class="relative pb-8">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="grid gap-5 lg:grid-cols-2">
                @foreach ($products as $slug => $product)
                    <a href="{{ Locales::route('product', ['product' => $slug]) }}"
                       class="reveal ring-gradient group relative overflow-hidden rounded-[1.75rem] glass p-8 transition-transform hover:-translate-y-1 lg:p-10">

                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-2xl font-bold text-white lg:text-3xl">{{ $product['name'] }}</h2>
                                <p class="mt-2 text-lg font-medium text-brand-200">{{ __("site.products.items.{$slug}.tagline") }}</p>
                            </div>
                            <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-300">{{ __('site.products.free_badge') }}</span>
                        </div>

                        <p class="mt-5 text-pretty leading-relaxed text-ink-300">{{ __("site.products.items.{$slug}.description") }}</p>

                        <div class="mt-7 flex flex-wrap gap-2">
                            <span class="rounded-full bg-white/8 px-3 py-1 text-xs font-medium text-ink-300">{{ $product['category'] }}</span>
                            <span class="rounded-full bg-white/8 px-3 py-1 text-xs font-medium text-ink-300">v{{ $product['version'] }}</span>
                            @if ($product['has_pro'])
                                <span class="rounded-full bg-brand-500/20 px-3 py-1 text-xs font-semibold text-brand-200">{{ __('site.products.pro_badge') }}</span>
                            @endif
                        </div>

                        <span class="mt-8 inline-flex items-center gap-1.5 text-sm font-semibold text-white">
                            {{ __('site.common.learn_more') }}
                            <x-ui.icon name="arrow" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.faq :faqs="$seo->faqs" />

    <x-ui.cta />

</x-layouts.site>
