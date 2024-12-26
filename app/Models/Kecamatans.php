<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatans extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'longitude', 'latitude',
    ];
    
    public function kelurahans()
    {
        return $this->hasMany(Kelurahans::class, 'kecamatan_id');
    }
}
