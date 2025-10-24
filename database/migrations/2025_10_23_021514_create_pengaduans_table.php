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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('status_pengirim');
            $table->string('kontak_pengirim');
            $table->string('subjek');
            $table->text('isi_pesan');
            $table->string('kategori_pengaduan');
            $table->string('jenis_pengaduan');
            $table->string('file_pengaduan')->nullable();
            $table->enum('status_tiket', ['pending', 'proses', 'selesai', 'ditolak'])->default('pending');
            $table->string('no_tiket')->unique();
            $table->text('tanggapan')->nullable();
            $table->date('tanggal_pengaduan');
            $table->date('tanggal_tanggapan')->nullable();
            $table->string('alasan_ditolak')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
