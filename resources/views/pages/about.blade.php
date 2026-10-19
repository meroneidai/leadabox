@php $company = config('site.company'); @endphp

<x-layouts.site :seo="$seo">

    <x-ui.page-hero
        :crumbs="$seo->breadcrumbs"
        :eyebrow="__('site.about.eyebrow')"
        :title="__('site.about.hero_title')"
        :body="__('site.about.hero_body')"
    />

    <section class="relative py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="ring-gradient reveal rounded-[1.75rem] glass p-8 lg:p-12">
                <div class="grid gap-8 lg:grid-cols-[1fr_1.4fr] lg:gap-16">
                    <h2 class="text-balance text-2xl font-bold text-white lg:text-3xl">{{ __('site.about.story_title') }}</h2>
                    <p class="text-pretty text-lg leading-relaxed text-ink-300">{{ __('site.about.story_body') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="grid gap-5 sm:grid-cols-2">
                @foreach (__('site.about.values') as $value)
                    <div class="reveal rounded-2xl border border-white/10 bg-white/[0.03] p-8" data-reveal-delay="{{ $loop->index * 70 }}">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-brand-400/25 to-violet-500/25 text-brand-200 ring-1 ring-inset ring-white/10">
                            <x-ui.icon name="shield" class="h-5 w-5" />
                        </span>
                        <h3 class="mt-5 text-lg font-semibold text-white">{{ $value['title'] }}</h3>
                        <p class="mt-2 leading-relaxed text-ink-400">{{ $value['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Studio details --}}
    <section class="relative pb-8">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="reveal grid gap-px overflow-hidden rounded-3xl border border-white/10 bg-white/5 sm:grid-cols-3">
                <div class="bg-ink-950/60 p-8">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-ink-400">{{ __('site.contact.details.address_title') }}</h2>
                    <address class="mt-3 not-italic leading-relaxed text-white">
                        {{ $company['street'] }}<br>
                        {{ $company['postal_code'] }} {{ $company['city'] }}<br>
                        {{ $company['country_name'] }}
                    </address>
                </div>
                <div class="bg-ink-950/60 p-8">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-ink-400">{{ __('site.contact.details.email_title') }}</h2>
                    <a href="mailto:{{ $company['email'] }}" class="mt-3 block text-white transition-colors hover:text-brand-200">{{ $company['email'] }}</a>
                </div>
                <div class="bg-ink-950/60 p-8">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.14em] text-ink-400">{{ __('site.contact.details.phone_title') }}</h2>
                    <a href="tel:{{ $company['phone'] }}" class="mt-3 block text-white transition-colors hover:text-brand-200">{{ $company['phone_display'] }}</a>
                </div>
            </div>
        </div>
    </section>

    <x-ui.faq :faqs="$seo->faqs" />

    <x-ui.cta />

</x-layouts.site>
