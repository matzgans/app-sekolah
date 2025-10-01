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
        Schema::create('profile_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('npsn')->nullable();
            $table->string('akreditasi')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->string('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('kepala_sekolah')->nullable();
            $table->text('sambutan_kepala_sekolah')->nullable();
            $table->string('foto_sekolah')->nullable();
            $table->string('foto_kepala_sekolah')->nullable();
            $table->string('logo_sekolah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_sekolahs');
    }
};
