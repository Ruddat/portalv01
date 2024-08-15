<?php

namespace App\Models;

use App\Models\ModSharedToolsPrinters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSharedToolsPrinterConfiguration extends Model
{
    use HasFactory;


    protected $fillable = ['shop_id', 'printer_id', 'computer_name'];

    public function printer()
    {
        return $this->belongsTo(ModSharedToolsPrinters::class);
    }
}
