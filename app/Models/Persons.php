<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Persons extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik', 'bpjs', 'nama', 'jenis_kelamin', 'tanggal_lahir',
        'alamat', 'rt', 'rw', 'kelurahan_id','telp','tempat_periksa',
        'status', 'valid', 'notifikasi','edited_by', 'created_by',
    ];

    public function Kunjungan(){
        return $this->hasMany(Kunjungans::class, 'person_id');
    }

    public function lastKunjungan()
    {
        return $this->hasOne(Kunjungans::class, 'person_id')->latestOfMany('tanggal_kj');
    }

    public function kelurahan(){
        return $this->belongsTo(Kelurahans::class, 'kelurahan_id');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'update_by');
    }

    public function validatedBy(){
        return $this->belongsTo(User::class, 'validate_by');
    }

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->tanggal_lahir)->age
        );
    }
    protected function category(): Attribute
    {
        return Attribute::make(
            get: function () {
                $age = Carbon::parse($this->tanggal_lahir)->age;
                if ($age >= 60) {
                    return 'Lansia'; // 60 tahun ke atas
                } elseif ($age >= 45) {
                    return 'Pra-Lansia'; // 45 hingga 59 tahun
                } else {
                    return 'Non-Lansia'; // Di bawah 45 tahun
                }
            }
        );
    }

}
