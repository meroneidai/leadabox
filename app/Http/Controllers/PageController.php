<?php

namespace App\Http\Controllers;

use App\Support\Locales;
use App\Support\Schema;
use App\Support\Seo;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    public function home(): View
    {
        $url = Locales::route('home');

        $seo = Seo::make()
            ->title(__('site.home.meta_title'))
            ->description(__('site.home.meta_description'))
            ->canonical($url)
            ->keywords(__('site.home.keywords'))
            ->image(asset('images/hero/leadabox-studio.jpg'), __('site.home.hero_image_alt'))
            ->faqs(__('site.home.faqs'))
            ->schema(Schema::webPage($url, __('site.home.meta_title'), __('site.home.meta_description')))
            ->schema(Schema::itemList(__('site.services.title'), $this->serviceLinks()));

        return view('pages.home', [
            'seo' => $seo,
            'services' => config('site.services'),
            'agents' => config('site.agents'),
            'platforms' => config('site.platforms'),
            'process' => config('site.process'),
            'cases' => config('site.cases'),
            'products' => config('site.products'),
        ]);
    }

    public function services(): View
    {
        $url = Locales::route('services');

        $seo = Seo::make()
            ->title(__('site.services.meta_title'))
            ->description(__('site.services.meta_description'))
            ->canonical($url)
            ->keywords(__('site.services.keywords'))
            ->breadcrumbs($this->crumbs([['services', __('site.nav.services')]]))
            ->faqs(__('site.services.faqs'))
            ->schema(Schema::webPage($url, __('site.services.meta_title'), __('site.services.meta_description')))
            ->schema(Schema::itemList(__('site.services.title'), $this->serviceLinks()));

        return view('pages.services', [
            'seo' => $seo,
            'services' => config('site.services'),
        ]);
    }

    public function service(string $service): View
    {
        $config = config("site.services.{$service}");

        if (! $config) {
            throw new NotFoundHttpException();
        }

        $url = Locales::route('service', ['service' => $service]);
        $copy = __("site.services.items.{$service}");

        $seo = Seo::make()
            ->title($copy['meta_title'])
            ->description($copy['meta_description'])
            ->canonical($url)
            ->keywords($copy['keywords'] ?? [])
            ->image(asset("images/services/{$service}.jpg"), $copy['title'])
            ->breadcrumbs($this->crumbs([
                ['services', __('site.nav.services')],
                ["services/{$service}", $copy['title']],
            ]))
            ->faqs($copy['faqs'] ?? [])
            ->schema(Schema::webPage($url, $copy['meta_title'], $copy['meta_description']))
            ->schema(Schema::service($url, $copy['title'], $copy['meta_description'], $copy['offers'] ?? []));

        return view('pages.service', [
            'seo' => $seo,
            'slug' => $service,
            'service' => $config,
            'copy' => $copy,
            'related' => collect(config('site.services'))->except($service)->take(3),
        ]);
    }

    public function agents(): View
    {
        $url = Locales::route('agents');

        $seo = Seo::make()
            ->title(__('site.agents.meta_title'))
            ->description(__('site.agents.meta_description'))
            ->canonical($url)
            ->keywords(__('site.agents.keywords'))
            ->breadcrumbs($this->crumbs([['ai-agents', __('site.nav.agents')]]))
            ->faqs(__('site.agents.faqs'))
            ->schema(Schema::webPage($url, __('site.agents.meta_title'), __('site.agents.meta_description')))
            ->schema(Schema::service($url, __('site.agents.title'), __('site.agents.meta_description')));

        return view('pages.agents', [
            'seo' => $seo,
            'agents' => config('site.agents'),
        ]);
    }

    public function products(): View
    {
        $url = Locales::route('products');

        $seo = Seo::make()
            ->title(__('site.products.meta_title'))
            ->description(__('site.products.meta_description'))
            ->canonical($url)
            ->breadcrumbs($this->crumbs([['products', __('site.nav.products')]]))
            ->faqs(__('site.products.faqs'))
            ->schema(Schema::webPage($url, __('site.products.meta_title'), __('site.products.meta_description')));

        return view('pages.products', [
            'seo' => $seo,
            'products' => config('site.products'),
        ]);
    }

    public function product(string $product): View
    {
        $config = config("site.products.{$product}");

        if (! $config) {
            throw new NotFoundHttpException();
        }

        $url = Locales::route('product', ['product' => $product]);
        $copy = __("site.products.items.{$product}");

        $seo = Seo::make()
            ->title($copy['meta_title'])
            ->description($copy['meta_description'])
            ->canonical($url)
            ->keywords($copy['keywords'] ?? [])
            ->image(asset("images/products/{$product}.jpg"), $config['name'])
            ->breadcrumbs($this->crumbs([
                ['products', __('site.nav.products')],
                ["products/{$product}", $config['name']],
            ]))
            ->faqs($copy['faqs'] ?? [])
            ->schema(Schema::webPage($url, $copy['meta_title'], $copy['meta_description']))
            ->schema(Schema::softwareApplication($url, $config, $copy));

        return view('pages.product', [
            'seo' => $seo,
            'slug' => $product,
            'product' => $config,
            'copy' => $copy,
        ]);
    }

    public function cases(): View
    {
        $url = Locales::route('cases');

        $seo = Seo::make()
            ->title(__('site.cases.meta_title'))
            ->description(__('site.cases.meta_description'))
            ->canonical($url)
            ->breadcrumbs($this->crumbs([['cases', __('site.nav.cases')]]))
            ->faqs(__('site.cases.faqs'))
            ->schema(Schema::webPage($url, __('site.cases.meta_title'), __('site.cases.meta_description')));

        return view('pages.cases', [
            'seo' => $seo,
            'cases' => config('site.cases'),
        ]);
    }

    public function caseStudy(string $case): View
    {
        $config = config("site.cases.{$case}");

        if (! $config) {
            throw new NotFoundHttpException();
        }

        $url = Locales::route('case', ['case' => $case]);
        $copy = __("site.cases.items.{$case}");

        $seo = Seo::make()
            ->title($copy['meta_title'])
            ->description($copy['meta_description'])
            ->canonical($url)
            ->type('article')
            ->image(asset("images/cases/{$case}.jpg"), $copy['title'])
            ->dates(($config['year'] ?? date('Y')).'-01-01')
            ->breadcrumbs($this->crumbs([
                ['cases', __('site.nav.cases')],
                ["cases/{$case}", $copy['title']],
            ]))
            ->faqs($copy['faqs'] ?? [])
            ->schema(Schema::webPage($url, $copy['meta_title'], $copy['meta_description']))
            ->schema(Schema::caseStudy($url, $config, $copy));

        return view('pages.case', [
            'seo' => $seo,
            'slug' => $case,
            'case' => $config,
            'copy' => $copy,
        ]);
    }

    public function about(): View
    {
        $url = Locales::route('about');

        $seo = Seo::make()
            ->title(__('site.about.meta_title'))
            ->description(__('site.about.meta_description'))
            ->canonical($url)
            ->breadcrumbs($this->crumbs([['about', __('site.nav.about')]]))
            ->faqs(__('site.about.faqs'))
            ->schema(Schema::webPage($url, __('site.about.meta_title'), __('site.about.meta_description')));

        return view('pages.about', ['seo' => $seo]);
    }

    public function privacy(): View
    {
        $url = Locales::route('privacy');

        return view('pages.legal', [
            'seo' => Seo::make()
                ->title(__('site.legal.privacy.title'))
                ->description(__('site.legal.privacy.description'))
                ->canonical($url)
                ->breadcrumbs($this->crumbs([['privacy', __('site.legal.privacy.title')]])),
            'copy' => __('site.legal.privacy'),
        ]);
    }

    public function terms(): View
    {
        $url = Locales::route('terms');

        return view('pages.legal', [
            'seo' => Seo::make()
                ->title(__('site.legal.terms.title'))
                ->description(__('site.legal.terms.description'))
                ->canonical($url)
                ->breadcrumbs($this->crumbs([['terms', __('site.legal.terms.title')]])),
            'copy' => __('site.legal.terms'),
        ]);
    }

    /** @param array<int, array{0: string, 1: string}> $segments */
    private function crumbs(array $segments): array
    {
        $prefix = Locales::prefix();
        $base = rtrim(config('app.url'), '/').($prefix ? "/{$prefix}" : '');

        $items = [['name' => __('site.nav.home'), 'url' => Locales::route('home')]];

        foreach ($segments as [$path, $name]) {
            $items[] = ['name' => $name, 'url' => "{$base}/{$path}"];
        }

        return $items;
    }

    private function serviceLinks(): array
    {
        return collect(config('site.services'))
            ->map(fn ($config, $slug) => [
                'name' => __("site.services.items.{$slug}.title"),
                'url' => Locales::route('service', ['service' => $slug]),
            ])
            ->values()
            ->all();
    }
}
