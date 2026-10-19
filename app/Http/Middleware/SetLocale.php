<?php

namespace App\Http\Middleware;

use App\Support\Locales;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next, ?string $locale = null): Response
    {
        $locale = $locale && in_array($locale, Locales::codes(), true)
            ? $locale
            : Locales::default();

        app()->setLocale($locale);

        $meta = Locales::meta($locale);
        setlocale(LC_TIME, $meta['locale'] ?? 'en_US');

        return $next($request);
    }
}
