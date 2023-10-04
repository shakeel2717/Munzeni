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
        Schema::create('futures', function (Blueprint $table) {
            $table->id();
            $table->enum('trade', ['one', 'five']);
            $table->enum('type', ['even', 'odd']);
            $table->boolean('status')->default(false);
            $table->bigInteger('timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('futures');
    }
};
