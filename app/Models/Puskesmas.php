<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'kode', 'jenis',
        'alamat', 'longitude', 'latitude',
    ];

    public function kelurahan()
    {
        return $this->hasMany(Kelurahans::class, 'puskesmas_kd', 'kode');
    }

    public function users(){
        return $this->hasMany(User::class, 'puskesmas_id');
    }
}
