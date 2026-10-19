@php use App\Support\Locales; @endphp

<section class="relative py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
        <div class="ring-gradient reveal relative overflow-hidden rounded-[2rem] glass-strong px-6 py-16 text-center sm:px-16 lg:py-20">

            <div class="pointer-events-none absolute inset-0" aria-hidden="true">
                <div class="absolute -top-1/2 start-1/4 h-[40rem] w-[40rem] rounded-full opacity-40 blur-[100px]"
                     style="background: radial-gradient(circle, #2d6cff 0%, transparent 65%);"></div>
                <div class="absolute -bottom-1/2 end-1/4 h-[32rem] w-[32rem] rounded-full opacity-30 blur-[100px]"
                     style="background: radial-gradient(circle, #7b2dff 0%, transparent 65%);"></div>
            </div>

            <div class="relative mx-auto max-w-2xl">
                <h2 class="text-balance text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    {{ __('site.common.ready_title') }}
                </h2>
                <p class="mt-6 text-pretty text-lg leading-relaxed text-ink-300">
                    {{ __('site.common.ready_body') }}
                </p>

                <div class="mt-10 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    <a href="{{ Locales::route('contact') }}"
                       class="group inline-flex w-full items-center justify-center gap-2 rounded-full bg-white px-7 py-4 text-base font-semibold text-ink-950 transition-all hover:shadow-[0_0_40px_-8px_rgb(93_140_255/0.9)] sm:w-auto">
                        {{ __('site.nav.cta') }}
                        <x-ui.icon name="arrow" class="h-4 w-4 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" />
                    </a>
                    <a href="https://wa.me/{{ config('site.company.whatsapp') }}" target="_blank" rel="noopener"
                       class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-white/20 px-7 py-4 text-base font-semibold text-white transition-colors hover:bg-white/5 sm:w-auto">
                        WhatsApp
                    </a>
                </div>

                <p class="mt-8 text-sm text-ink-400">
                    {{ __('site.common.response_time') }} &middot; {{ __('site.common.based_in') }}
                </p>
            </div>
        </div>
    </div>
</section>
