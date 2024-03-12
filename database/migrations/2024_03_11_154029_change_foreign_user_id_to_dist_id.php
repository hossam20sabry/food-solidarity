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
        Schema::table('donor_complaints', function (Blueprint $table) {
            $table->renameColumn('user_id', 'dist_id');
            $table->foreign('dist_id')->references('id')->on('dists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donor_complaints', function (Blueprint $table) {
            //
        });
    }
};
