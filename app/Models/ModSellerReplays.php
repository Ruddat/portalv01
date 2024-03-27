<?php

namespace App\Models;

use App\Models\ModSellerVotings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModSellerReplays extends Model
{
    use HasFactory;


    /**
     * Get the rating that owns the reply.
     */
    public function rating()
    {
        return $this->belongsTo(ModSellerVotings::class, 'voting_id');
    }
}
