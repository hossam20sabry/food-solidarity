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
        Schema::table('protein_protein_types', function (Blueprint $table) {
            $table->integer('qty')->nullable();
            $table->date('exp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('protein_protein_types', function (Blueprint $table) {
            $table->dropColumn('qty');
            $table->dropColumn('exp');
        });
    }
};
