<?php

namespace App\Models;

use App\Models\ModOrders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSellerVotings extends Model
{
    use HasFactory;



    public function order()
    {
        return $this->belongsTo(ModOrders::class, 'order_id');
    }


}
