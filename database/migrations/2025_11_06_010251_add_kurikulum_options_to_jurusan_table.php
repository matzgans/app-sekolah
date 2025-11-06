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
        Schema::table('jurusan', function (Blueprint $table) {
            $table->json('kelompok_options')->nullable()->after('logo_jurusan');
            $table->json('sub_kelompok_options')->nullable()->after('kelompok_options');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jurusan', function (Blueprint $table) {
            $table->dropColumn(['kelompok_options', 'sub_kelompok_options']);
        });
    }
};
