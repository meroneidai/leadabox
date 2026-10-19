<?php

namespace App\Support;

use Illuminate\Support\Arr;

/**
 * Per-page SEO payload. Controllers build one of these and the layout renders
 * the meta tags, Open Graph, Twitter card, canonical, hreflang and JSON-LD.
 */
class Seo
{
    public string $title = '';
    public string $description = '';
    public string $canonical = '';
    public string $type = 'website';
    public ?string $image = null;
    public ?string $imageAlt = null;
    public array $keywords = [];
    public array $breadcrumbs = [];
    public array $faqs = [];
    public array $schemas = [];
    public bool $noindex = false;
    public ?string $publishedAt = null;
    public ?string $modifiedAt = null;

    public static function make(): static
    {
        return new static();
    }

    public function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function canonical(string $url): static
    {
        $this->canonical = $url;

        return $this;
    }

    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function image(?string $image, ?string $alt = null): static
    {
        $this->image = $image;
        $this->imageAlt = $alt;

        return $this;
    }

    public function keywords(array $keywords): static
    {
        $this->keywords = $keywords;

        return $this;
    }

    /** @param array<int, array{name: string, url: string}> $items */
    public function breadcrumbs(array $items): static
    {
        $this->breadcrumbs = $items;

        return $this;
    }

    /** @param array<int, array{question: string, answer: string}> $faqs */
    public function faqs(array $faqs): static
    {
        $this->faqs = array_values(array_filter($faqs, fn ($f) => ! empty($f['question']) && ! empty($f['answer'])));

        return $this;
    }

    public function schema(array $schema): static
    {
        $this->schemas[] = $schema;

        return $this;
    }

    public function noindex(bool $noindex = true): static
    {
        $this->noindex = $noindex;

        return $this;
    }

    public function dates(?string $published, ?string $modified = null): static
    {
        $this->publishedAt = $published;
        $this->modifiedAt = $modified ?? $published;

        return $this;
    }

    public function fullTitle(): string
    {
        $name = config('site.company.name');

        return $this->title === ''
            ? $name
            : (str_contains($this->title, $name) ? $this->title : "{$this->title} | {$name}");
    }

    public function ogImage(): string
    {
        return $this->image ?: asset('images/og/leadabox-og.jpg');
    }

    /** Every JSON-LD block rendered on the page, as one @graph. */
    public function graph(): array
    {
        $graph = array_merge(
            [Schema::organization(), Schema::website()],
            $this->schemas,
        );

        if ($this->breadcrumbs) {
            $graph[] = Schema::breadcrumbs($this->breadcrumbs);
        }

        if ($this->faqs) {
            $graph[] = Schema::faq($this->faqs);
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => array_values(array_filter($graph)),
        ];
    }

    public function jsonLd(): string
    {
        return json_encode(
            $this->graph(),
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        ) ?: '{}';
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return Arr::get(get_object_vars($this), $key, $default);
    }
}
