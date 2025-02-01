<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungans extends Model
{
    protected $fillable = [
        'tinggi_bdn', 'berat_bdn', 'lingkar_prt', 'sistole', 'diastole', 'gula_drh', 'kolesterol', 'asam_urat',
        'person_id','tanggal_kj','created_by'
    ];

    public function person(){
        return $this->belongsTo(Persons::class, 'person_id');
    }

    public function latestKunjungan()
    {
        return $this->hasOne(Kunjungans::class, 'person_id')->orderByDesc('tanggal_kj');
    }

    public function skrinings(){
        return $this->hasMany(Skrinings::class, 'kunjungan_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
