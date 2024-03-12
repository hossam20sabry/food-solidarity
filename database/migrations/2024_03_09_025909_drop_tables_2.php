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
        Schema::dropIfExists('protein_protein_types');
        Schema::dropIfExists('proteins');
        Schema::dropIfExists('dry_food');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
