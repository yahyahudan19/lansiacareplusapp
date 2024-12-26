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

    public function kelurahans()
    {
        return $this->hasMany(Kelurahans::class, 'puskesmas_id');
    }

    public function users(){
        return $this->hasMany(User::class, 'puskesmas_id');
    }
}
