<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Arsip_surat extends Model
{
    use HasFactory,LogsActivity;
    protected $fillable = ['title', 'description', 'date', 'file_path', 'user_id'];


    
      // Log konfigurasi
      public function getActivitylogOptions(): LogOptions
      {
          return LogOptions::defaults()
              ->useLogName('arsip_surat') // Nama log
              ->logOnly(['title', 'description', 'date']) // Kolom yang dicatat
              ->setDescriptionForEvent(fn(string $eventName) => "Surat {$eventName}"); // Deskripsi log
      }
     // Relasi ke user
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
