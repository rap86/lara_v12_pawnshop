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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // 1. Make name unique so you don't accidentally get duplicate '2fa' rows
            $table->string('name')->unique();

            // 2. Change status to enum or string with a default value to prevent invalid states
            $table->string('status')->default('inactive');

            // 3. Change details to text instead of string (varchar) in case your explanation gets long
            $table->text('details')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
