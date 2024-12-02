<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kopma extends Model
{
    
    //use HasFactory;

    protected $fillable = [
        'item_name',
        'quantity',
        'item_price',
    ];

    /**
     * Relasi ke OrderItem.
     * Satu item di tabel kopma dapat dimasukkan dalam banyak order item.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
