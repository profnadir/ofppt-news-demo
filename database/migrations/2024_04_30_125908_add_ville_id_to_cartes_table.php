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
        Schema::table('cartes', function (Blueprint $table) {
            $table->dropColumn('ville');
            $table->foreignId('ville_id')->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cartes', function (Blueprint $table) {
            $table->string('ville');
            $table->dropForeign(['ville_id']);
            $table->dropColumn('ville_id');
        });
    }
};
