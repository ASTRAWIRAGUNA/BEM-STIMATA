<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kopma extends Model
{
    
    protected $table = 'kopmas';

    protected $fillable = [
        // 'peminjaman_id',
        'item_name',
        'quantity',
        'item_price'
        
    ];
}
