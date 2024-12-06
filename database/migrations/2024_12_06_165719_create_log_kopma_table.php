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
        Schema::create('log_kopmas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id') // Foreign Key to orders table
            ->constrained()
            ->onDelete('cascade');
             $table->foreignId('user_id') // Foreign Key to cashiers table
            ->constrained()
            ->onDelete('cascade');
            $table->dateTime('transaction_date'); // Transaction Date
            $table->decimal('total_amount', 15, 2); // Total Amount with precision 15, scale 2
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_kopma');
    }
};
