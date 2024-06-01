<?php

namespace App\Models;

use App\Models\ModSellerVotings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSellerVotes extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function voting()
    {
        return $this->belongsTo(ModSellerVotings::class);
    }


}
