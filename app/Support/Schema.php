<?php

namespace App\Support;

/**
 * Schema.org builders. Every node gets a stable @id so the @graph can cross
 * reference instead of repeating the organization on every node.
 */
class Schema
{
    public static function id(string $fragment): string
    {
        return rtrim(config('app.url'), '/').'/#'.ltrim($fragment, '#');
    }

    public static function organization(): array
    {
        $c = config('site.company');

        return [
            '@type' => ['Organization', 'ProfessionalService'],
            '@id' => static::id('organization'),
            'name' => $c['name'],
            'legalName' => $c['legal_name'],
            'url' => config('app.url'),
            'logo' => [
                '@type' => 'ImageObject',
                '@id' => static::id('logo'),
                'url' => asset('images/leadabox-logo.svg'),
                'contentUrl' => asset('images/leadabox-logo.svg'),
                'width' => 512,
                'height' => 512,
                'caption' => $c['name'],
            ],
            'image' => ['@id' => static::id('logo')],
            'foundingDate' => $c['founded'],
            'email' => $c['email'],
            'telephone' => $c['phone'],
            'priceRange' => '$$',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $c['street'],
                'postalCode' => $c['postal_code'],
                'addressLocality' => $c['city'],
                'addressRegion' => $c['region'],
                'addressCountry' => $c['country'],
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $c['latitude'],
                'longitude' => $c['longitude'],
            ],
            'contactPoint' => [
                [
                    '@type' => 'ContactPoint',
                    'telephone' => $c['phone'],
                    'email' => $c['email'],
                    'contactType' => 'customer support',
                    'areaServed' => ['SE', 'NO', 'DK', 'SA', 'AE', 'EU'],
                    'availableLanguage' => ['English', 'Swedish', 'Arabic', 'Norwegian', 'Danish'],
                ],
            ],
            'sameAs' => array_values(array_filter(config('site.social', []))),
            'areaServed' => [
                ['@type' => 'Country', 'name' => 'Sweden'],
                ['@type' => 'Country', 'name' => 'Norway'],
                ['@type' => 'Country', 'name' => 'Denmark'],
                ['@type' => 'Country', 'name' => 'Saudi Arabia'],
            ],
        ];
    }

    public static function website(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => static::id('website'),
            'url' => config('app.url'),
            'name' => config('site.company.name'),
            'publisher' => ['@id' => static::id('organization')],
            'inLanguage' => array_map(
                fn ($m) => $m['hreflang'],
                config('site.locales'),
            ),
        ];
    }

    public static function webPage(string $url, string $name, string $description, ?string $image = null): array
    {
        return array_filter([
            '@type' => 'WebPage',
            '@id' => $url.'#webpage',
            'url' => $url,
            'name' => $name,
            'description' => $description,
            'isPartOf' => ['@id' => static::id('website')],
            'about' => ['@id' => static::id('organization')],
            'primaryImageOfPage' => $image ? ['@type' => 'ImageObject', 'url' => $image] : null,
            'inLanguage' => Locales::meta()['hreflang'],
        ]);
    }

    public static function service(string $url, string $name, string $description, array $offers = []): array
    {
        return array_filter([
            '@type' => 'Service',
            '@id' => $url.'#service',
            'name' => $name,
            'description' => $description,
            'url' => $url,
            'provider' => ['@id' => static::id('organization')],
            'serviceType' => $name,
            'areaServed' => [
                ['@type' => 'Country', 'name' => 'Sweden'],
                ['@type' => 'Country', 'name' => 'Norway'],
                ['@type' => 'Country', 'name' => 'Denmark'],
                ['@type' => 'Country', 'name' => 'Saudi Arabia'],
            ],
            'hasOfferCatalog' => $offers ? [
                '@type' => 'OfferCatalog',
                'name' => $name,
                'itemListElement' => array_map(fn ($o) => [
                    '@type' => 'Offer',
                    'itemOffered' => ['@type' => 'Service', 'name' => $o],
                ], $offers),
            ] : null,
        ]);
    }

    public static function softwareApplication(string $url, array $product, array $copy): array
    {
        return array_filter([
            '@type' => 'SoftwareApplication',
            '@id' => $url.'#software',
            'name' => $product['name'],
            'description' => $copy['description'] ?? '',
            'url' => $url,
            'applicationCategory' => 'DeveloperApplication',
            'applicationSubCategory' => $product['category'] ?? null,
            'operatingSystem' => 'WordPress 6.2+',
            'softwareVersion' => $product['version'] ?? null,
            'author' => ['@id' => static::id('organization')],
            'publisher' => ['@id' => static::id('organization')],
            'offers' => [
                '@type' => 'Offer',
                'price' => '0',
                'priceCurrency' => 'USD',
                'availability' => 'https://schema.org/InStock',
            ],
        ]);
    }

    public static function caseStudy(string $url, array $case, array $copy): array
    {
        return array_filter([
            '@type' => 'Article',
            '@id' => $url.'#article',
            'headline' => $copy['title'] ?? '',
            'description' => $copy['description'] ?? '',
            'url' => $url,
            'author' => ['@id' => static::id('organization')],
            'publisher' => ['@id' => static::id('organization')],
            'datePublished' => ($case['year'] ?? date('Y')).'-01-01',
            'about' => [
                '@type' => 'Organization',
                'name' => $case['client'] ?? '',
                'url' => $case['url'] ?? null,
            ],
        ]);
    }

    /** @param array<int, array{name: string, url: string}> $items */
    public static function breadcrumbs(array $items): array
    {
        return [
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_map(fn ($item, $i) => [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ], $items, array_keys($items)),
        ];
    }

    /** @param array<int, array{question: string, answer: string}> $faqs */
    public static function faq(array $faqs): array
    {
        return [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => strip_tags($faq['answer']),
                ],
            ], $faqs),
        ];
    }

    public static function itemList(string $name, array $items): array
    {
        return [
            '@type' => 'ItemList',
            'name' => $name,
            'itemListElement' => array_map(fn ($item, $i) => [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item['name'],
                'url' => $item['url'],
            ], $items, array_keys($items)),
        ];
    }
}
