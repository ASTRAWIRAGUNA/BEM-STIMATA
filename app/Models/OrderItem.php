<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    
    public function order(){
        
        return $this->belongsTo(OrderItem::class);
    }

    public function kopma(){
        
        return $this->belongsTo(OrderItem::class);
    }
}
