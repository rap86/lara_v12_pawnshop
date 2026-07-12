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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('status')->default('active');

            // 2. Define the foreign key constraint
            $table->foreign('branch_id')
                ->references('id')
                ->on('branches')
                ->onDelete('set null'); // Keeps the user but clears their branch if the branch is deleted

            // Native true/false switch, defaults to false for standard staff
            $table->boolean('is_floating')->default(false);

            // --- NEW 2FA & NOTIFICATION CHANNELS ---
            // Destination Contacts
            $table->string('phone_number')->nullable(); // Required for SMS delivery
            $table->string('chat_id_viber')->nullable();
            $table->string('chat_id_telegram')->nullable();

            // 2FA Channel User Preferences (Defaulting to false/opt-in)
            $table->boolean('two_factor_sms')->default(false);
            $table->boolean('two_factor_gmail')->default(false);
            $table->boolean('two_factor_yahoo')->default(false);
            $table->boolean('two_factor_viber')->default(false);
            $table->boolean('two_factor_telegram')->default(false);

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
