<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('api_settings', function (Blueprint $table) {
            $table->id();

            // Core Identity
            $table->string('service_provider', 100); // e.g., 'Telegram', 'Twilio'
            $table->string('api_type', 50); // e.g., 'telegram', 'viber', 'sms', 'email'
            $table->string('unique_code', 50)->unique(); // e.g., 'telegram_primary'

            // Connection Details
            $table->string('base_url', 255)->nullable();
            $table->text('api_key')->nullable();   // Cast as 'encrypted' in Model
            $table->text('auth_token')->nullable(); // Cast as 'encrypted' in Model
            $table->json('config_payload')->nullable(); // For Sender IDs, headers, etc.

            // Operational Flags
            $table->enum('environment', ['sandbox', 'production'])->default('sandbox');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_fallback')->default(false);
            $table->integer('priority')->default(0);

            // Health & Telemetry (Excellent for Admin UI)
            $table->timestamp('last_used_at')->nullable();
            $table->enum('last_status', ['success', 'failed', 'unknown'])->default('unknown');
            $table->text('last_error_message')->nullable();

            $table->timestamps();

            // Indexes for fast lookup during login/2FA dispatch
            $table->index(['api_type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_settings');
    }
};
