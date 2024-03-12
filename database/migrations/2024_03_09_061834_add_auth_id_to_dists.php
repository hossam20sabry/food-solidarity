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
        Schema::table('dists', function (Blueprint $table) {
            $table->unsignedBigInteger('auth_type_id');
            $table->foreign('auth_type_id')->references('id')->on('auth_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dists', function (Blueprint $table) {
            //
        });
    }
};
