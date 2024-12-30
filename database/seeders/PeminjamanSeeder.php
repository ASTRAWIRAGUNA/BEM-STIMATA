<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peminjaman')->insert([
            [
                'inventory_id' => 1, // ID Inventory
                'nama_peminjam' => 'John Doe',
                'surat_id' => null, // ID Surat (nullable, bisa null)
                'borrow_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'return_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'inventory_id' => 2, // ID Inventory
                'nama_peminjam' => 'Jane Smith',
                'surat_id' => null, // Surat tidak diperlukan
                'borrow_date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'return_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'status' => 'Approved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'inventory_id' => 3, // ID Inventory
                'nama_peminjam' => 'Alex Johnson',
                'surat_id' => null, // ID Surat
                'borrow_date' => Carbon::now()->subDays(15)->format('Y-m-d'),
                'return_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'status' => 'Returned',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
