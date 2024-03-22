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
        Schema::create('protein_protein_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('protein_id');
            $table->unsignedBigInteger('protein_type_id');

            $table->foreign('protein_id')->references('id')->on('proteins')->onDelete('cascade');
            $table->foreign('protein_type_id')->references('id')->on('protein_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protein_protein_types');
    }
};
