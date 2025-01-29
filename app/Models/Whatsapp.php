<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Whatsapp extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_whatsapp', 'api_key', 'endpoint','type_message' ,'keterangan','status'
    ];
}
