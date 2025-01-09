<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikators extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'kelompok_id'
    ];

    public function kelompok(){
        return $this->belongsTo(Kelompoks::class, 'kelompok_id');
    }
}
