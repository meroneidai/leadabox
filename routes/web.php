<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Http\Middleware\SetLocale;
use App\Support\Locales;
use Illuminate\Support\Facades\Route;

Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('robots.txt', [SitemapController::class, 'robots'])->name('robots');

/*
 | Every public page is registered once per locale. The default locale lives at
 | the root, the rest behind their URL prefix (/se, /ar, /no, /dk). Route names
 | are prefixed with the locale code so Locales::route() can resolve them.
 */
foreach (Locales::all() as $code => $meta) {
    Route::middleware(SetLocale::class.':'.$code)
        ->prefix($meta['prefix'] ?? '')
        ->name($code.'.')
        ->group(function () {
            Route::get('/', [PageController::class, 'home'])->name('home');

            Route::get('services', [PageController::class, 'services'])->name('services');
            Route::get('services/{service}', [PageController::class, 'service'])->name('service');

            Route::get('ai-agents', [PageController::class, 'agents'])->name('agents');

            Route::get('products', [PageController::class, 'products'])->name('products');
            Route::get('products/{product}', [PageController::class, 'product'])->name('product');

            Route::get('cases', [PageController::class, 'cases'])->name('cases');
            Route::get('cases/{case}', [PageController::class, 'caseStudy'])->name('case');

            Route::get('about', [PageController::class, 'about'])->name('about');

            Route::get('contact', [ContactController::class, 'show'])->name('contact');
            Route::post('contact', [ContactController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('contact.store');

            Route::get('privacy', [PageController::class, 'privacy'])->name('privacy');
            Route::get('terms', [PageController::class, 'terms'])->name('terms');
        });
}

Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('licenses', [LicenseController::class, 'index'])->name('licenses');
    Route::get('licenses/create', [LicenseController::class, 'create'])->name('licenses.create');
    Route::post('licenses', [LicenseController::class, 'store'])->name('licenses.store');
    Route::get('licenses/{license}', [LicenseController::class, 'show'])->name('licenses.show');
    Route::patch('licenses/{license}', [LicenseController::class, 'update'])->name('licenses.update');
    Route::delete('licenses/{license}/activations/{activation}', [LicenseController::class, 'deactivate'])
        ->name('licenses.deactivate');
});

require __DIR__.'/auth.php';
