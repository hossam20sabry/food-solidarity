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
        Schema::create('donor_complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dist_id');
            $table->text('content');
            $table->boolean('answered')->default(false);
            $table->timestamps();

            $table->foreign('dist_id')->references('id')->on('dists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_complaints');
    }
};
