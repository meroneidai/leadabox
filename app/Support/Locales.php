<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;

class Locales
{
    public static function all(): array
    {
        return config('site.locales', []);
    }

    public static function codes(): array
    {
        return array_keys(static::all());
    }

    public static function default(): string
    {
        return config('app.locale', 'en');
    }

    public static function current(): string
    {
        return app()->getLocale();
    }

    public static function meta(?string $code = null): array
    {
        $code ??= static::current();

        return static::all()[$code] ?? static::all()[static::default()];
    }

    public static function dir(?string $code = null): string
    {
        return static::meta($code)['dir'] ?? 'ltr';
    }

    public static function isRtl(?string $code = null): bool
    {
        return static::dir($code) === 'rtl';
    }

    /** URL prefix for a locale; the default locale is served from the root. */
    public static function prefix(?string $code = null): string
    {
        return static::meta($code)['prefix'] ?? '';
    }

    /** Resolve a locale from its URL prefix, e.g. "se" => "sv". */
    public static function fromPrefix(?string $prefix): ?string
    {
        if ($prefix === null || $prefix === '') {
            return static::default();
        }

        foreach (static::all() as $code => $meta) {
            if ($meta['prefix'] === $prefix) {
                return $code;
            }
        }

        return null;
    }

    /**
     * Build a route name scoped to a locale. Routes are registered once per
     * locale with the locale code as the name prefix.
     */
    public static function route(string $name, array $parameters = [], ?string $locale = null): string
    {
        $locale ??= static::current();

        $scoped = "{$locale}.{$name}";

        if (! Route::has($scoped)) {
            $scoped = static::default().".{$name}";
        }

        return route($scoped, $parameters);
    }

    /**
     * The same page in another locale, used by the language switcher and by
     * the hreflang tags. Falls back to that locale's home page.
     */
    public static function alternate(string $locale): string
    {
        $current = Route::currentRouteName();

        if (! $current) {
            return static::route('home', [], $locale);
        }

        $name = preg_replace('/^[a-z]{2}\./', '', $current);
        $parameters = Route::current()?->parameters() ?? [];

        $scoped = "{$locale}.{$name}";

        return Route::has($scoped)
            ? route($scoped, $parameters)
            : static::route('home', [], $locale);
    }
}
