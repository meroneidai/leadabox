<?php

namespace App\Http\Controllers;

use App\Mail\ContactConfirmation;
use App\Mail\ContactEnquiry;
use App\Models\ContactSubmission;
use App\Support\Locales;
use App\Support\Schema;
use App\Support\Seo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show(): View
    {
        $url = Locales::route('contact');
        $c = config('site.company');

        $seo = Seo::make()
            ->title(__('site.contact.meta_title'))
            ->description(__('site.contact.meta_description'))
            ->canonical($url)
            ->breadcrumbs([
                ['name' => __('site.nav.home'), 'url' => Locales::route('home')],
                ['name' => __('site.nav.contact'), 'url' => $url],
            ])
            ->faqs(Locales::content('site.contact.faqs'))
            ->schema(Schema::webPage($url, __('site.contact.meta_title'), __('site.contact.meta_description')))
            ->schema([
                '@type' => 'ContactPage',
                '@id' => $url.'#contactpage',
                'url' => $url,
                'name' => __('site.contact.meta_title'),
                'mainEntity' => ['@id' => Schema::id('organization')],
            ]);

        return view('pages.contact', [
            'seo' => $seo,
            'services' => config('site.services'),
            'company' => $c,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc,dns', 'max:190'],
            'company' => ['nullable', 'string', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'service' => ['nullable', 'string', 'max:60'],
            'budget' => ['nullable', 'string', 'max:40'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            // Honeypot: real users never fill this in.
            'website' => ['prohibited'],
        ]);

        $submission = ContactSubmission::create($data + [
            'locale' => Locales::current(),
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
        ]);

        // The lead is already stored, so a mail outage must never surface as an error.
        try {
            Mail::to(config('site.company.email'))->send(new ContactEnquiry($submission));
            Mail::to($submission->email)->send(new ContactConfirmation($submission));
        } catch (\Throwable $e) {
            Log::error('Contact mail failed', ['id' => $submission->id, 'error' => $e->getMessage()]);
        }

        return back()->with('contact_sent', true);
    }
}
