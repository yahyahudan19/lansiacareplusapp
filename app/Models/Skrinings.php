<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skrinings extends Model
{
    protected $fillable = [
        'ginjal', 'penglihatan', 'pendengaran', 'merokok', 'adl', 'gds', 'kunjungan_id','keterangan'
    ];

    public function kunjungan(){
        return $this->belongsTo(Kunjungans::class, 'kunjungan_id');
    }
}
