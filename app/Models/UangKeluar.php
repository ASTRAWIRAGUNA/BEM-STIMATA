<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UangKeluar extends Model
{
    protected $table = 'uang_keluar';

    protected $fillable = [
        'tanggal',
        'keterangan',
        'jumlah',
    ];
}
