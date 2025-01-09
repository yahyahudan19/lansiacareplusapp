<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompoks extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'deskripsi',
    ];

    public function indikator(){
        return $this->hasMany(Indikators::class, 'kelompok_id');
    }
}
