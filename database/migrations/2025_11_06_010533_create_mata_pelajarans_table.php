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
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurusan_id')->constrained('jurusan')->cascadeOnDelete();
            $table->string('kelompok');
            $table->string('sub_kelompok')->nullable();
            $table->string('kode_mapel')->nullable();
            $table->string('nama_mapel');
            $table->string('tingkat');
            $table->string('semester');
            $table->integer('alokasi_waktu_jp')->nullable();
            $table->json('kompetensi_dasar')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_pelajarans');
    }
};
