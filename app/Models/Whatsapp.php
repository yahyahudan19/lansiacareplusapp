<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Whatsapp extends Model
{
    use HasFactory;

    protected $keyType = 'string';  // UUID adalah string
    public $incrementing = false;   // UUID tidak auto increment
    protected $table = 'whatsapps'; // Nama tabel

    protected $fillable = [
        'nomor_whatsapp', 'api_key', 'endpoint','type_message' ,'keterangan','status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();  // Generate UUID
            }
        });
    }
}
