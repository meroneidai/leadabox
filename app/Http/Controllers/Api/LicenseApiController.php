<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\LicenseActivation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Licensing endpoints consumed by our products (Bitra Optimizer first).
 * Stateless and key-based: a site posts its key plus its own URL.
 */
class LicenseApiController extends Controller
{
    public function activate(Request $request): JsonResponse
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:64'],
            'site_url' => ['required', 'url', 'max:255'],
            'site_name' => ['nullable', 'string', 'max:190'],
            'product' => ['required', 'string', 'max:60'],
            'version' => ['nullable', 'string', 'max:20'],
        ]);

        $license = $this->resolve($data['key'], $data['product']);

        if (! $license instanceof License) {
            return $license;
        }

        $site = $this->normalizeUrl($data['site_url']);

        $activation = $license->activations()->firstWhere('site_url', $site);

        if ($activation && $activation->isActive()) {
            $activation->update([
                'last_seen_at' => now(),
                'product_version' => $data['version'] ?? $activation->product_version,
            ]);

            return $this->success($license, 'Already activated on this site.');
        }

        if ($license->seatsRemaining() < 1) {
            return response()->json([
                'success' => false,
                'code' => 'no_seats',
                'message' => 'All seats for this license are in use. Release a site first.',
                'seats' => $license->seats,
                'seats_used' => $license->seats,
            ], 409);
        }

        LicenseActivation::updateOrCreate(
            ['license_id' => $license->id, 'site_url' => $site],
            [
                'site_name' => $data['site_name'] ?? null,
                'product_version' => $data['version'] ?? null,
                'ip_address' => $request->ip(),
                'last_seen_at' => now(),
                'deactivated_at' => null,
            ],
        );

        return $this->success($license->fresh(), 'License activated.');
    }

    public function validateKey(Request $request): JsonResponse
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:64'],
            'site_url' => ['required', 'url', 'max:255'],
            'product' => ['required', 'string', 'max:60'],
        ]);

        $license = $this->resolve($data['key'], $data['product']);

        if (! $license instanceof License) {
            return $license;
        }

        $activation = $license->activations()
            ->whereNull('deactivated_at')
            ->firstWhere('site_url', $this->normalizeUrl($data['site_url']));

        if (! $activation) {
            return response()->json([
                'success' => false,
                'code' => 'not_activated',
                'message' => 'This site is not activated for the supplied license.',
            ], 403);
        }

        $activation->update(['last_seen_at' => now()]);

        return $this->success($license, 'License is valid.');
    }

    public function deactivate(Request $request): JsonResponse
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:64'],
            'site_url' => ['required', 'url', 'max:255'],
            'product' => ['required', 'string', 'max:60'],
        ]);

        $license = $this->resolve($data['key'], $data['product']);

        if (! $license instanceof License) {
            return $license;
        }

        $license->activations()
            ->whereNull('deactivated_at')
            ->where('site_url', $this->normalizeUrl($data['site_url']))
            ->update(['deactivated_at' => now()]);

        return response()->json(['success' => true, 'message' => 'Seat released.']);
    }

    private function resolve(string $key, string $product): License|JsonResponse
    {
        $license = License::where('key', $key)->where('product_slug', $product)->first();

        if (! $license) {
            return response()->json([
                'success' => false,
                'code' => 'invalid_key',
                'message' => 'That license key was not found for this product.',
            ], 404);
        }

        if ($license->status !== 'active') {
            return response()->json([
                'success' => false,
                'code' => $license->status,
                'message' => "This license is {$license->status}.",
            ], 403);
        }

        if ($license->isExpired()) {
            return response()->json([
                'success' => false,
                'code' => 'expired',
                'message' => 'This license expired on '.$license->expires_at->toDateString().'.',
                'expires_at' => $license->expires_at->toIso8601String(),
            ], 403);
        }

        return $license;
    }

    private function success(License $license, string $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'plan' => $license->plan,
            'status' => $license->status,
            'seats' => $license->seats,
            'seats_used' => $license->seats - $license->seatsRemaining(),
            'expires_at' => $license->expires_at?->toIso8601String(),
        ]);
    }

    /** Strip scheme noise so http/https and trailing slashes map to one seat. */
    private function normalizeUrl(string $url): string
    {
        $host = parse_url($url, PHP_URL_HOST) ?: $url;
        $path = rtrim(parse_url($url, PHP_URL_PATH) ?: '', '/');

        return strtolower(preg_replace('/^www\./', '', $host).$path);
    }
}
