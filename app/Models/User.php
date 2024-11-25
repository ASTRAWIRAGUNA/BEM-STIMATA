<?php

// app/Models/User.php
namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


    // inverse one to Many ke tabel role
    // public function role() {
    //     return $this->belongsTo(Role::class, 'role_id');
    // }

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
