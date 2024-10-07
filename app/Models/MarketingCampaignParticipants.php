<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingCampaignParticipants extends Model
{
    use HasFactory;

    protected $table = 'marketing_campaign_participants';

    protected $guarded = [];



    protected $casts = [
        'valid_until' => 'date', // Cast valid_until as a date
    ];

    public function shop()
    {
        return $this->belongsTo(ModShop::class, 'shop_id');
    }

    public function marketingSetting()
    {
        return $this->belongsTo(ModAdminMarketingSetting::class, 'marketing_setting_id');
    }

}
