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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dist_id');
            $table->unsignedBigInteger('donation_type')->nullable();
            $table->bigInteger('quantity');
            $table->enum('status', [ 'pending','confirmed', 'matched'])->default('pending');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('target')->nullable();
            $table->timestamp('matched_at')->nullable();
            $table->timestamps();
            $table->foreign('dist_id')->references('id')->on('dists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
