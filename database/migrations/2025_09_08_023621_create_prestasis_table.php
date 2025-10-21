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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nama_siswa');
            $table->string('nama_guru_pembimbing');
            $table->text('deskripsi')->nullable();
            $table->enum('tingkat', ['sekolah', 'kota',  'provinsi', 'nasional', 'internasional']);
            $table->enum('jenis_prestasi', ['akademik', 'non akademik', 'olahraga', 'seni', 'karya ilmiah', 'lainnya']);
            $table->year('tahun');
            $table->string('slug');
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
