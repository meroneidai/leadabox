<?php

namespace App\Http\Controllers;

use App\Support\Locales;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Multilingual sitemap: every page is listed once per locale with a full
     * set of xhtml:link alternates, which is what Google expects for hreflang.
     */
    public function index(): Response
    {
        $pages = $this->pages();
        $locales = Locales::all();

        $xml = ['<?xml version="1.0" encoding="UTF-8"?>'];
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

        foreach ($pages as $page) {
            foreach (array_keys($locales) as $code) {
                $xml[] = '  <url>';
                $xml[] = '    <loc>'.e(Locales::route($page['name'], $page['params'] ?? [], $code)).'</loc>';

                foreach ($locales as $altCode => $meta) {
                    $xml[] = sprintf(
                        '    <xhtml:link rel="alternate" hreflang="%s" href="%s"/>',
                        $meta['hreflang'],
                        e(Locales::route($page['name'], $page['params'] ?? [], $altCode)),
                    );
                }

                $xml[] = sprintf(
                    '    <xhtml:link rel="alternate" hreflang="x-default" href="%s"/>',
                    e(Locales::route($page['name'], $page['params'] ?? [], Locales::default())),
                );

                $xml[] = '    <changefreq>'.$page['freq'].'</changefreq>';
                $xml[] = '    <priority>'.$page['priority'].'</priority>';
                $xml[] = '    <lastmod>'.now()->toAtomString().'</lastmod>';
                $xml[] = '  </url>';
            }
        }

        $xml[] = '</urlset>';

        return response(implode("\n", $xml), 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            'Disallow: /dashboard',
            'Disallow: /login',
            'Disallow: /register',
            '',
            'Sitemap: '.route('sitemap'),
        ];

        return response(implode("\n", $lines), 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    private function pages(): array
    {
        $pages = [
            ['name' => 'home', 'freq' => 'weekly', 'priority' => '1.0'],
            ['name' => 'services', 'freq' => 'weekly', 'priority' => '0.9'],
            ['name' => 'agents', 'freq' => 'weekly', 'priority' => '0.9'],
            ['name' => 'products', 'freq' => 'weekly', 'priority' => '0.8'],
            ['name' => 'cases', 'freq' => 'monthly', 'priority' => '0.8'],
            ['name' => 'about', 'freq' => 'monthly', 'priority' => '0.6'],
            ['name' => 'contact', 'freq' => 'monthly', 'priority' => '0.7'],
            ['name' => 'privacy', 'freq' => 'yearly', 'priority' => '0.2'],
            ['name' => 'terms', 'freq' => 'yearly', 'priority' => '0.2'],
        ];

        foreach (array_keys(config('site.services')) as $slug) {
            $pages[] = ['name' => 'service', 'params' => ['service' => $slug], 'freq' => 'monthly', 'priority' => '0.9'];
        }

        foreach (array_keys(config('site.products')) as $slug) {
            $pages[] = ['name' => 'product', 'params' => ['product' => $slug], 'freq' => 'monthly', 'priority' => '0.8'];
        }

        foreach (array_keys(config('site.cases')) as $slug) {
            $pages[] = ['name' => 'case', 'params' => ['case' => $slug], 'freq' => 'monthly', 'priority' => '0.7'];
        }

        return $pages;
    }
}
