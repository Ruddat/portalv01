<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModTopRankPrice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mod_top_rank_prices';

    // Dies schützt keine Felder, sodass alle im Model verfügbar sind
    protected $guarded = [];
    protected $appends = ['logo_url'];

    // Accessor für das Logo-URL
    public function getLogoUrlAttribute()
    {
        $logoUrl = $this->logo ? asset('uploads/shops/' . $this->id . '/images/' . $this->logo) : asset('uploads/images/default/logo.png');

        // Debug-Ausgabe
        \Log::info('Logo URL: ' . $logoUrl);

        return $logoUrl;
    }
}
