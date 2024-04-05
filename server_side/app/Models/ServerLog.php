<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'user_level',
        'request_description',
        'http_request_type',
        'request_time',
    ];
}
