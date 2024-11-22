<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;





class User extends Authenticatable
{
    use HasFactory,Notifiable;
    
    protected $fillable = [
        'name', 'nim', 'password', 'email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // inverse one to Many ke tabel role
    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // public function logActivities()
    // {
    //     return $this->hasMany(LogActivity::class);
    // }

    // public function absensis()
    // {
    //     return $this->hasMany(Absensi::class);
    // }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }

    // public function pendaftaranUkms()
    // {
    //     return $this->hasMany(PendaftaranUKM::class);
    // }

    // public function userUkms()
    // {
    //     return $this->belongsToMany(UKM::class, 'user_ukms');
    // }

    // public function peminjamans()
    // {
    //     return $this->hasMany(Peminjaman::class, 'penanggung_jawab');
    // }
}
