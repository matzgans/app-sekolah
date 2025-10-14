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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi_berita');
            $table->string('thumbnail')->nullable();
            $table->bigInteger('views')->default(0);
            $table->date('tanggal_publikasi')->nullable();
            $table->string('slug');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('status', ['draf', 'publikasi'])->default('draf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
