<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModBuyerDeleteToken extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'token', 'expires_at'];

}
