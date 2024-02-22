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
        Schema::create('dry_food_dry_food_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dry_food_id');
            $table->unsignedBigInteger('dry_food_type_id');
            $table->bigInteger('quantity');
            $table->timestamps();

            $table->foreign('dry_food_id')->references('id')->on('dry_food')->onDelete('cascade');
            $table->foreign('dry_food_type_id')->references('id')->on('dry_food_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dry_food_dry_food_types');
    }
};
