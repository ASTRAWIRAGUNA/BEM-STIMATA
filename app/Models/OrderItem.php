<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //use HasFactory;

    protected $fillable = [
        'order_id',
        'kopma_id',
        'item_name',
        'quantity',
        'price_per_unit',
        'total_price',
    ];

    /**
     * Relasi ke model Order (Many-to-One).
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi ke model Kopma (Many-to-One).
     */
    public function kopma()
    {
        return $this->belongsTo(Kopma::class);
    }
}
