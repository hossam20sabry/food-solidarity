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
            $table->unsignedBigInteger('donation_type_id');
            $table->bigInteger('quantity');
            $table->enum('status', ['confirmed', 'matched'])->default('confirmed');
            $table->timestamps();
            $table->foreign('dist_id')->references('id')->on('dists')->onDelete('cascade');
            $table->foreign('donation_type_id')->references('id')->on('donation_types')->onDelete('cascade');
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
