@php use App\Support\Locales; @endphp

<x-layouts.site :seo="$seo">

    <x-ui.page-hero
        :crumbs="$seo->breadcrumbs"
        :eyebrow="__('site.contact.eyebrow')"
        :title="__('site.contact.hero_title')"
        :body="__('site.contact.hero_body')"
    />

    <section class="relative pb-8">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="grid gap-6 lg:grid-cols-[1.3fr_1fr]">

                {{-- Form --}}
                <div class="reveal ring-gradient rounded-[1.75rem] glass p-7 lg:p-10">
                    @if (session('contact_sent'))
                        <div class="rounded-2xl border border-emerald-400/30 bg-emerald-400/10 p-6">
                            <h2 class="flex items-center gap-2 text-lg font-semibold text-white">
                                <x-ui.icon name="check" class="h-5 w-5 text-emerald-300" />
                                {{ __('site.contact.form.success_title') }}
                            </h2>
                            <p class="mt-2 leading-relaxed text-ink-200">{{ __('site.contact.form.success_body') }}</p>
                        </div>
                    @else
                        <h2 class="text-2xl font-bold text-white">{{ __('site.contact.form.title') }}</h2>

                        <form method="POST" action="{{ Locales::route('contact.store') }}" class="mt-8 space-y-5">
                            @csrf

                            {{-- Honeypot --}}
                            <div class="hidden" aria-hidden="true">
                                <label for="website">Website</label>
                                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="grid gap-5 sm:grid-cols-2">
                                <x-form.field name="name" :label="__('site.contact.form.name')" required autocomplete="name" />
                                <x-form.field name="email" type="email" :label="__('site.contact.form.email')" required autocomplete="email" />
                                <x-form.field name="company" :label="__('site.contact.form.company')" autocomplete="organization" />
                                <x-form.field name="phone" type="tel" :label="__('site.contact.form.phone')" autocomplete="tel" />
                            </div>

                            <div class="grid gap-5 sm:grid-cols-2">
                                <x-form.select name="service" :label="__('site.contact.form.service')" :placeholder="__('site.contact.form.service_placeholder')">
                                    @foreach ($services as $slug => $service)
                                        <option value="{{ $slug }}" @selected(old('service') === $slug)>{{ __("site.services.items.{$slug}.title") }}</option>
                                    @endforeach
                                </x-form.select>

                                <x-form.select name="budget" :label="__('site.contact.form.budget')" :placeholder="__('site.contact.form.budget_placeholder')">
                                    @foreach (\App\Support\Locales::content('site.contact.budgets') as $key => $label)
                                        <option value="{{ $key }}" @selected(old('budget') === $key)>{{ $label }}</option>
                                    @endforeach
                                </x-form.select>
                            </div>

                            <x-form.field
                                name="message"
                                type="textarea"
                                :label="__('site.contact.form.message')"
                                :placeholder="__('site.contact.form.message_placeholder')"
                                required
                            />

                            <button type="submit"
                                    class="group inline-flex w-full items-center justify-center gap-2 rounded-full bg-white px-7 py-4 text-base font-semibold text-ink-950 transition-all hover:shadow-[0_0_40px_-8px_rgb(93_140_255/0.9)] sm:w-auto">
                                {{ __('site.contact.form.submit') }}
                                <x-ui.icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
                            </button>

                            <p class="text-xs leading-relaxed text-ink-500">{{ __('site.contact.form.consent') }}</p>
                        </form>
                    @endif
                </div>

                {{-- Details --}}
                <div class="reveal space-y-4" data-reveal-delay="100">
                    <a href="mailto:{{ $company['email'] }}"
                       class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition-all hover:border-white/25 hover:bg-white/[0.06]">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-500/15 text-brand-200 ring-1 ring-inset ring-white/10">
                            <x-ui.icon name="mail" class="h-5 w-5" />
                        </span>
                        <span class="min-w-0">
                            <span class="block text-sm font-semibold text-white">{{ __('site.contact.details.email_title') }}</span>
                            <span class="mt-1 block truncate text-ink-300">{{ $company['email'] }}</span>
                        </span>
                    </a>

                    <a href="tel:{{ $company['phone'] }}"
                       class="group flex items-start gap-4 rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition-all hover:border-white/25 hover:bg-white/[0.06]">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-400/15 text-emerald-300 ring-1 ring-inset ring-white/10">
                            <x-ui.icon name="headset" class="h-5 w-5" />
                        </span>
                        <span class="min-w-0">
                            <span class="block text-sm font-semibold text-white">{{ __('site.contact.details.phone_title') }}</span>
                            <span class="mt-1 block text-ink-300">{{ $company['phone_display'] }}</span>
                            <span class="mt-2 inline-flex items-center gap-1.5 text-sm font-medium text-emerald-300">WhatsApp &middot; {{ __('site.common.response_time') }}</span>
                        </span>
                    </a>

                    <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">
                        <div class="flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-violet-500/15 text-violet-200 ring-1 ring-inset ring-white/10">
                                <x-ui.icon name="building" class="h-5 w-5" />
                            </span>
                            <div>
                                <span class="block text-sm font-semibold text-white">{{ __('site.contact.details.address_title') }}</span>
                                <address class="mt-1 not-italic leading-relaxed text-ink-300">
                                    {{ $company['street'] }}<br>
                                    {{ $company['postal_code'] }} {{ $company['city'] }}<br>
                                    {{ $company['country_name'] }}
                                </address>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6">
                        <div class="flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-400/15 text-amber-200 ring-1 ring-inset ring-white/10">
                                <x-ui.icon name="calendar" class="h-5 w-5" />
                            </span>
                            <div>
                                <span class="block text-sm font-semibold text-white">{{ __('site.contact.details.hours_title') }}</span>
                                <p class="mt-1 text-ink-300">{{ __('site.contact.details.hours_body') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-ui.faq :faqs="$seo->faqs" />

</x-layouts.site>
