<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahans extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'kecamatan_id', 'puskesmas_kd', 'longitude', 'latitude',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatans::class, 'kecamatan_id');
    }

    public function puskesmas()
    {
        return $this->belongsTo(Puskesmas::class, 'puskesmas_kd', 'kode');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'kelurahan_id');
    }
    public function persons()
    {
        return $this->belongsTo(Persons::class, 'kelurahan_id');
    }
    
}
