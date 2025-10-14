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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug');
            $table->text('deskripsi');
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->enum('tipe', ['informasi', 'kegiatan', 'akademik', 'lainnya'])->default('informasi');
            $table->string('gambar')->nullable();
            $table->string('file_pengumuman')->nullable();
            $table->string('link')->nullable();
            $table->enum('status', ['draf', 'publikasi'])->default('draf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
