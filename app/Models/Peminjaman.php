<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Peminjaman extends Model
{
    use HasFactory,LogsActivity;

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
        return $this->belongsTo(Inventory::class,'inventory_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // Relasi ke arsip surat
    public function surat()
    {
        return $this->belongsTo(Arsip_surat::class, 'surat_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['inventory_id', 'status']) // Kolom yang dilog
            ->useLogName('Peminjaman'); // Nama log default
    }
}
