<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\LicenseActivation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index(Request $request): View
    {
        $licenses = License::query()
            ->withCount(['activations' => fn ($q) => $q->whereNull('deactivated_at')])
            ->when($request->string('q')->toString(), function ($q, $term) {
                $q->where(fn ($w) => $w
                    ->where('key', 'like', "%{$term}%")
                    ->orWhere('customer_email', 'like', "%{$term}%")
                    ->orWhere('customer_name', 'like', "%{$term}%"));
            })
            ->when($request->string('status')->toString(), fn ($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('dashboard.licenses.index', [
            'licenses' => $licenses,
            'products' => config('site.products'),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.licenses.create', [
            'products' => config('site.products'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_slug' => ['required', 'string', 'max:60'],
            'plan' => ['required', 'in:pro,agency,lifetime'],
            'seats' => ['required', 'integer', 'min:1', 'max:1000'],
            'customer_name' => ['nullable', 'string', 'max:160'],
            'customer_email' => ['required', 'email', 'max:190'],
            'expires_at' => ['nullable', 'date', 'after:today'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $license = License::create($data + [
            'user_id' => $request->user()->id,
            'key' => License::generateKey($data['product_slug']),
            'status' => 'active',
        ]);

        return redirect()
            ->route('dashboard.licenses.show', $license)
            ->with('status', __('dashboard.licenses.created'));
    }

    public function show(License $license): View
    {
        $license->load(['activations' => fn ($q) => $q->latest()]);

        return view('dashboard.licenses.show', ['license' => $license]);
    }

    public function update(Request $request, License $license): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:active,suspended,revoked'],
            'seats' => ['required', 'integer', 'min:1', 'max:1000'],
            'expires_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $license->update($data);

        return back()->with('status', __('dashboard.licenses.updated'));
    }

    public function deactivate(License $license, LicenseActivation $activation): RedirectResponse
    {
        abort_unless($activation->license_id === $license->id, 404);

        $activation->update(['deactivated_at' => now()]);

        return back()->with('status', __('dashboard.licenses.seat_released'));
    }
}
