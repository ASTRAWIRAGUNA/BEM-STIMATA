<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

    protected $fillable = [
        'item_name',
        'category',
        'stock',
        'availability_status',
        'requires_letter',
    ];

    // Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'inventory_id');
    }

     // Metode untuk mengurangi stok
     public function decreaseStock($quantity = 1)
     {
         // Validasi stok mencukupi
    if ($this->stock < $quantity) {
        throw new \Exception('Stok tidak mencukupi untuk pengurangan ini.');
    }

    // Kurangi stok
    $this->stock -= $quantity;

    // Perbarui status ketersediaan
    $this->availability_status = $this->stock > 0 ? 'Available' : 'Unavailable';

    // Simpan perubahan
    $this->save();

    // Opsional: Log aktivitas
    activity()
        ->performedOn($this)
        ->log('Stok barang dikurangi sebanyak ' . $quantity);
     }
 
     // Metode untuk menambah stok
     public function increaseStock($quantity = 1)
     {
         $this->stock += $quantity;
         $this->availability_status = 'Available'; // Jika barang dikembalikan, status pasti tersedia
         $this->save();
     }
}
