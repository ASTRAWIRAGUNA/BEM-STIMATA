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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('inventory_id'); // Foreign Key ke inventories
            $table->foreign('inventory_id')
                ->references('id') // Default kolom primary key laravel
                ->on('inventories')
                ->onDelete('cascade');
        
            $table->string('nama_peminjam')->nullable(); // Kolom untuk nama peminjam
        
            $table->unsignedBigInteger('surat_id')->nullable(); // Foreign Key ke arsip_surats
            $table->foreign('surat_id')
                ->references('id') // Default kolom primary key laravel
                ->on('arsip_surats')
                ->onDelete('cascade');
        
            $table->date('borrow_date');
            $table->date('return_date');
            $table->enum('status', ['Pending', 'Approved', 'Returned'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
