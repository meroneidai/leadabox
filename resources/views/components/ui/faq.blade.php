@props(['faqs' => [], 'title' => null, 'subtitle' => null])

@if (count($faqs))
    <section class="relative py-24 lg:py-32" aria-labelledby="faq-heading">
        <div class="mx-auto max-w-7xl px-5 sm:px-8">
            <div class="grid gap-12 lg:grid-cols-[0.8fr_1.2fr] lg:gap-20">

                <div class="lg:sticky lg:top-28 lg:self-start">
                    <x-ui.section-heading
                        :eyebrow="__('site.common.faq_title')"
                        :title="$title ?? __('site.common.faq_title')"
                        :body="$subtitle ?? __('site.common.faq_subtitle')"
                        as="h2"
                    />
                    <div id="faq-heading" class="sr-only">{{ __('site.common.faq_title') }}</div>
                </div>

                <div data-faq class="space-y-3">
                    @foreach ($faqs as $i => $faq)
                        <details class="reveal group rounded-2xl border border-white/10 bg-white/[0.03] transition-colors hover:border-white/20 open:border-brand-400/40 open:bg-brand-500/[0.07]"
                                 data-reveal-delay="{{ $i * 50 }}">
                            <summary class="flex cursor-pointer list-none items-start justify-between gap-6 p-6 [&::-webkit-details-marker]:hidden">
                                <h3 class="text-base font-semibold text-white sm:text-lg">{{ $faq['question'] }}</h3>
                                <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full border border-white/15 text-ink-300 transition-transform duration-300 group-open:rotate-45 group-open:border-brand-400/60 group-open:text-brand-200">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5">
                                        <path d="M12 5v14M5 12h14"/>
                                    </svg>
                                </span>
                            </summary>
                            <div class="px-6 pb-6 -mt-1">
                                <p class="text-pretty leading-relaxed text-ink-300">{{ $faq['answer'] }}</p>
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
