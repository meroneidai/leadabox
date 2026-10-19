<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 190)->index();
            $table->string('company', 160)->nullable();
            $table->string('phone', 40)->nullable();
            $table->string('service', 60)->nullable();
            $table->string('budget', 40)->nullable();
            $table->text('message');
            $table->string('locale', 5)->default('en');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamp('handled_at')->nullable();
            $table->timestamps();
        });

        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_slug', 60)->index();
            $table->string('key', 64)->unique();
            $table->string('plan', 30)->default('pro');
            $table->string('status', 20)->default('active')->index();
            $table->unsignedSmallInteger('seats')->default(1);
            $table->string('customer_email', 190)->nullable()->index();
            $table->string('customer_name', 160)->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('license_activations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('license_id')->constrained()->cascadeOnDelete();
            $table->string('site_url', 255);
            $table->string('site_name', 190)->nullable();
            $table->string('product_version', 20)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamp('deactivated_at')->nullable();
            $table->timestamps();

            $table->unique(['license_id', 'site_url']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_activations');
        Schema::dropIfExists('licenses');
        Schema::dropIfExists('contact_submissions');
    }
};
