<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Models\License;
use App\Models\LicenseActivation;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'stats' => [
                'licenses' => License::count(),
                'active' => License::where('status', 'active')->count(),
                'activations' => LicenseActivation::whereNull('deactivated_at')->count(),
                'leads' => ContactSubmission::whereNull('handled_at')->count(),
            ],
            'recentLicenses' => License::with('activations')->latest()->take(8)->get(),
            'recentLeads' => ContactSubmission::latest()->take(8)->get(),
        ]);
    }
}
