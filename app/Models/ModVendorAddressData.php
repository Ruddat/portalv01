<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModVendorAddressData extends Model
{
    use HasFactory;


    protected $table = 'mod_vendor_address_data';


    protected $fillable = [
        'street', 'housenumber', 'postal_code', 'city', 'latitude', 'longitude',
    ];


}
