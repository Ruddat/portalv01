<?php

namespace App\Models;

use App\Models\ModOrders;
use App\Models\ModSellerVotes;
use App\Models\ModSellerReplays;
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

    /**
     * Get the replies for the rating.
     */
    public function replies()
    {
        return $this->hasMany(ModSellerReplays::class, 'voting_id');
    }


    public function replays()
    {
        return $this->hasMany(ModSellerReplay::class, 'voting_id');
    }


    public function shopData()
    {
        return $this->belongsTo(ModOrders::class, 'shop_id', 'parent');
    }

    // Optional: Beziehung zum Client-Modell
    public function user()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }

}
