@php
    use App\Support\Locales;
    $company = config('site.company');
@endphp

<footer class="relative z-10 mt-32 border-t border-white/8 bg-ink-950/60 backdrop-blur-sm">
    <div class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-20">

        <div class="grid gap-12 lg:grid-cols-[1.4fr_1fr_1fr_1.2fr]">

            <div>
                <a href="{{ Locales::route('home') }}" class="flex items-center gap-2.5 text-white">
                    <img src="{{ asset('images/leadabox-mark.svg') }}" alt="" width="36" height="36" class="h-9 w-9">
                    <span class="text-lg font-bold tracking-tight">Leadabox</span>
                </a>
                <p class="mt-5 max-w-sm text-sm leading-relaxed text-ink-400">
                    {{ __('site.footer.tagline') }}
                </p>
                <div class="mt-6">
                    <x-site.language-switcher :inline="true" />
                </div>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">{{ __('site.footer.services_title') }}</h2>
                <ul class="mt-4 space-y-3 text-sm">
                    @foreach (config('site.services') as $slug => $service)
                        <li>
                            <a href="{{ Locales::route('service', ['service' => $slug]) }}"
                               class="text-ink-400 transition-colors hover:text-white">
                                {{ __("site.services.items.{$slug}.title") }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">{{ __('site.footer.company_title') }}</h2>
                <ul class="mt-4 space-y-3 text-sm">
                    <li><a href="{{ Locales::route('about') }}" class="text-ink-400 transition-colors hover:text-white">{{ __('site.nav.about') }}</a></li>
                    <li><a href="{{ Locales::route('cases') }}" class="text-ink-400 transition-colors hover:text-white">{{ __('site.nav.cases') }}</a></li>
                    <li><a href="{{ Locales::route('products') }}" class="text-ink-400 transition-colors hover:text-white">{{ __('site.nav.products') }}</a></li>
                    <li><a href="{{ Locales::route('agents') }}" class="text-ink-400 transition-colors hover:text-white">{{ __('site.nav.agents') }}</a></li>
                    <li><a href="{{ Locales::route('contact') }}" class="text-ink-400 transition-colors hover:text-white">{{ __('site.nav.contact') }}</a></li>
                </ul>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-white">{{ __('site.footer.contact_title') }}</h2>
                <ul class="mt-4 space-y-3 text-sm text-ink-400">
                    <li>
                        <a href="mailto:{{ $company['email'] }}" class="transition-colors hover:text-white">{{ $company['email'] }}</a>
                    </li>
                    <li>
                        <a href="tel:{{ $company['phone'] }}" class="transition-colors hover:text-white">{{ $company['phone_display'] }}</a>
                    </li>
                    <li>
                        <a href="https://wa.me/{{ $company['whatsapp'] }}" rel="noopener" target="_blank"
                           class="inline-flex items-center gap-1.5 transition-colors hover:text-white">
                            WhatsApp
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5">
                                <path d="M7 17 17 7M9 7h8v8"/>
                            </svg>
                        </a>
                    </li>
                    <li class="pt-2">
                        <address class="not-italic leading-relaxed">
                            {{ $company['street'] }}<br>
                            {{ $company['postal_code'] }} {{ $company['city'] }}<br>
                            {{ $company['country_name'] }}
                        </address>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-14 flex flex-col gap-4 border-t border-white/8 pt-8 text-sm text-ink-500 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} {{ $company['name'] }}. {{ __('site.footer.rights') }}</p>
            <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                <a href="{{ Locales::route('privacy') }}" class="transition-colors hover:text-white">{{ __('site.legal.privacy.title') }}</a>
                <a href="{{ Locales::route('terms') }}" class="transition-colors hover:text-white">{{ __('site.legal.terms.title') }}</a>
                <span class="text-ink-600">{{ __('site.footer.built') }}</span>
            </div>
        </div>
    </div>
</footer>
