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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('first_name',20);
            $table->string('middle_name',20)->nullable();
            $table->string('last_name',20);
            $table->string('gender',20)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('marital_status',20)->nullable();
            $table->string('email',40)->nullable();
            $table->string('cellphone_number',20)->nullable();
            $table->string('occupation',100)->nullable();
            $table->string('address',200)->nullable();
            $table->string('details',100)->nullable();
            $table->string('image_name',1000)->nullable();
            $table->string('image_location',150)->nullable();
            $table->string('image_size',20)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('branch_id')
                    ->references('id')
                    ->on('branches')
                    ->onDelete('set null');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
