<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportTask extends Model
{
    protected $fillable = ['user_id','filename','disk','path','status','meta'];
    protected $casts = ['meta' => 'array'];
}
