<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModAdminMarketingSetting extends Model
{
    use HasFactory;

    protected $fillable = ['duration', 'discount_percentage', 'validity_days', 'usage_limit'];


}
