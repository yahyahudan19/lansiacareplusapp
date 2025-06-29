<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','username','email','activity', 'details','category',
    ];

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('d F Y - H:i');
    }
}
