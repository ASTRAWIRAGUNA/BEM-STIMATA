<?php

// app/Models/User.php
namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory,Notifiable,LogsActivity;
    
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama','nim',  'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nama', 'nim', 'role']) // Kolom yang dicatat
            ->useLogName('user_activity') // Nama log (opsional)
            ->logOnlyDirty(); // Hanya mencatat perubahan
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
