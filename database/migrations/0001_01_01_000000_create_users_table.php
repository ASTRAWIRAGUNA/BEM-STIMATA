<?php

// database/migrations/xxxx_xx_xx_create_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            // $table->string('nama');
            $table->string('password');
            $table->enum('role', ['admin', 'sekertaris', 'bendahara', 'kominfo',])->default('admin');
            $table->rememberToken();
            $table->timestamps();
        });

        //after clone tambahkan skema ini
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');  // Kolom payload harus ada
            $table->integer('last_activity')->index();
        });
        
    }
    

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
