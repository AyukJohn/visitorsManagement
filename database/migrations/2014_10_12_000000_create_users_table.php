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
            // $table->id();

            $table->uuid('id', 8)->primary();

            $table->string('full_name');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('user_tag')->unique()->nullable();
            $table->string('transactionPin')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('is_Banned')->default('false');
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();

            $table->string('account_reference')->nullable();
            $table->string('barter_id')->nullable();
            $table->string('country')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('status')->nullable();
            $table->string('user_bank_id')->nullable();
            $table->float('referral_bonus')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
