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
        $users = [
            [
                'nama' => 'Adm',
                'nim' => '22.31.0001',
                // 'username' => '22.31.0001',
                'password' => Hash::make('admin'),
                'role' => 'Admin',
            ],
            [
                'nama' => 'SekretM',
                'nim' => '22.31.0002',
                // 'username' => '22.31.0002',
                'password' => Hash::make('sekretaris'),
                'role' => 'Sekretaris',
            ],
            [
                'nama' => 'BendEM',
                'nim' => '22.31.6903',
                // 'username' => '22.31.0003',
                'password' => Hash::make('bendahara'),
                'role' => 'Bendahara',
            ],
            [
                'nama' => 'Kom BEM',
                'nim' => '22.31.7694',
                // 'username' => '22.31.0004',
                'password' => Hash::make('kominfo'),
                'role' => 'Kominfo',
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }

    }
        // User::create([
        //     'username' => 'test',
        //     'password' => Hash::make('123`'), // Pastikan password di-hash
        //     'role' => 'Admin', // Jika kolom ini ada di tabel users
        // ]);
    
}
