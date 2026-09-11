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
        Schema::table('mantan_terindah', function (Blueprint $table) {
            $table->string('makanan_favorit')->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mantan_terindah', function (Blueprint $table) {
            $table->dropColumn('makanan_favorit');
        });
    }
};
