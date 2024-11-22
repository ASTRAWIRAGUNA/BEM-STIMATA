<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Role::create([
            'role_name' => 'admin',
        ]);

        Role::create([
            'role_name' => 'bendahara',
        ]);
        Role::create([
            'role_name' => 'sekretaris',
        ]);
        Role::create([
            'role_name' => 'kominfo',
        ]);
        
        User::factory(5)->create();

    }
        // User::create([
        //     'username' => 'test',
        //     'password' => Hash::make('123`'), // Pastikan password di-hash
        //     'role' => 'Admin', // Jika kolom ini ada di tabel users
        // ]);
    
}
