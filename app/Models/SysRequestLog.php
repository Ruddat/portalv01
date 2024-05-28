<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SysRequestLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address', 'url', 'method', 'user_agent', 'timestamp', 'count',
    ];

}
