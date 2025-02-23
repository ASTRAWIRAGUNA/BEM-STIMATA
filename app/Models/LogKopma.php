<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogKopma extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'user_id', 'transaction_date', 'total_amount'];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
