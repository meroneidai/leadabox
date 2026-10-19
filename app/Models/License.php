<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_slug', 'key', 'plan', 'status',
        'seats', 'customer_email', 'customer_name', 'expires_at', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'seats' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function activations(): HasMany
    {
        return $this->hasMany(LicenseActivation::class);
    }

    /** Human-readable, grouped key: LBX-BITRA-XXXX-XXXX-XXXX */
    public static function generateKey(string $productSlug): string
    {
        $product = strtoupper(substr(preg_replace('/[^a-z]/i', '', $productSlug), 0, 5));

        $blocks = collect(range(1, 3))
            ->map(fn () => strtoupper(Str::random(4)))
            ->implode('-');

        return "LBX-{$product}-{$blocks}";
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && ! $this->isExpired();
    }

    public function seatsRemaining(): int
    {
        return max(0, $this->seats - $this->activations()->whereNull('deactivated_at')->count());
    }
}
