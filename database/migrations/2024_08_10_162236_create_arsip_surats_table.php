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
        Schema::create('arsip_surats', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Judul surat
            $table->string('description'); // desc surat
            $table->date('date'); // Tanggal surat
            $table->string('file_path'); // Lokasi file surat (untuk upload PDF)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Relasi ke tabel users
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_surats');
    }
};
