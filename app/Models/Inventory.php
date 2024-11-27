<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

    // protected $primaryKey = 'inventory_id';
    // protected $primaryKey = 'id';

    protected $fillable = [
        'item_name',
        'category',
        'availability_status',
        'requires_letter',
    ];

    // Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'inventory_id');
    }
}
