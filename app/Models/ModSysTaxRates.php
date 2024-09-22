<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModSysTaxRates extends Model
{
    use HasFactory;

    protected $table = 'mod_sys_tax_rates';
    protected $fillable = ['country_code', 'standard_rate', 'reduced_rate', 'category'];
    
}
