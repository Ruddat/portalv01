<?php

namespace App\Models;

use App\Models\ModOrders;
use App\Models\ModSellerVotes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSellerVotings extends Model
{
    use HasFactory;

    protected $table = 'mod_seller_votings';


    public function order()
    {
        return $this->belongsTo(ModOrders::class, 'order_id');
    }


    public function votes()
    {
        return $this->hasMany(ModSellerVotes::class, 'voting_id');
    }

}
