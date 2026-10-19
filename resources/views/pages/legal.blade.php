<x-layouts.site :seo="$seo">

    <x-ui.page-hero
        :crumbs="$seo->breadcrumbs"
        :title="$copy['title']"
        :body="$copy['description']"
    >
        <p class="reveal mt-6 text-sm text-ink-500" data-reveal-delay="200">
            {{ $copy['updated'] }}: {{ now()->format('F Y') }}
        </p>
    </x-ui.page-hero>

    <section class="relative pb-8">
        <div class="mx-auto max-w-3xl px-5 sm:px-8">
            <div class="space-y-4">
                @foreach ($copy['sections'] as $section)
                    <article class="reveal rounded-2xl border border-white/10 bg-white/[0.03] p-7" data-reveal-delay="{{ $loop->index * 50 }}">
                        <h2 class="text-lg font-semibold text-white">{{ $section['title'] }}</h2>
                        <p class="mt-3 text-pretty leading-relaxed text-ink-300">{{ $section['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.cta />

</x-layouts.site>
