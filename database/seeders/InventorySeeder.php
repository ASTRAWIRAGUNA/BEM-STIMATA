<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inventory;


class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventory::create([
            'item_name' => 'Laptop',
            'category' => 'Elektronik',
            'availability_status' => 'Available',
        ]);

        Inventory::create([
            'item_name' => 'Proyektor',
            'category' => 'Elektronik',
            'availability_status' => 'Available',
        ]);
    }
}
