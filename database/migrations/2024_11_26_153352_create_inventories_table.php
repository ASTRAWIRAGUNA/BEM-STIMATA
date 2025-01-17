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
        Schema::create('inventories', function (Blueprint $table) {
            // $table->id('inventory_id'); // Primary Key
            $table->id(); // Primary Key
            $table->string('item_name'); // Nama barang
            $table->string('category'); // Kategori barang
            $table->integer('stock')->default(0); // Tambahkan kolom stok setelah kategori
            $table->enum('availability_status', ['Available', 'Unavailable'])->default('Available'); // Status barang
            $table->boolean('requires_letter')->default(true); // Default barang membutuhkan surat
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
