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
    Schema::table('karyawans', function (Blueprint $table) {
        $table->foreignId('departemen_id')
              ->nullable()
              ->constrained('departemen')
              ->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('karyawans', function (Blueprint $table) {
        $table->dropForeign(['departemen_id']);
        $table->dropColumn('departemen_id');
    });
}
};
