<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        // 'peminjaman_id',
        'inventory_id',
        'user_id',
        'surat_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    // Relasi ke inventory
    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }

    // Relasi ke arsip surat
    public function surat()
    {
        return $this->belongsTo(Arsip_surat::class, 'id');
    }
}
