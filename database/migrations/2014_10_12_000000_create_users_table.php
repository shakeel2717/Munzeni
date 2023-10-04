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
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->enum('status', ['pending', 'active', 'suspend'])->default('pending');
            $table->string('refer')->default('default');
            $table->boolean('authenticator')->default(false);
            $table->string('authenticator_code')->nullable();
            $table->string('user_code')->unique();
            $table->rememberToken();
            $table->enum('kyc_status', ['rejected', 'approved', 'pending', 'under-review'])->default('pending');
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
