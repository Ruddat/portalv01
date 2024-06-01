<?php

namespace App\Livewire\Frontend\Votings;

use Livewire\Component;
use App\Models\ModSellerVotings;

class RatingSummary extends Component
{


    public $overallRating;
    public $numberOfRatings;
    public $showRatings = false;


    public function mount($shopId)
    {
        $this->shopId = $shopId;
        $this->calculateOverallRating();
      //  $this->votingId = $votingId;


    }

    public function calculateOverallRating()
    {
        // Beispiel-Berechnungslogik, anpassen nach Ihren Bedürfnissen
        $ratings = ModSellerVotings::where('shop_id', $this->shopId)->get();
        $totalRatings = $ratings->count();

        if ($totalRatings > 0) {
            $totalScore = $ratings->sum(function ($rating) {
                return ($rating->food_quality + $rating->service + $rating->punctuality + $rating->price) / 4;
            });

            $this->overallRating = $totalScore / $totalRatings;
            $this->numberOfRatings = $totalRatings;
            $this->overallRatingProgress = ($this->overallRating / 10) * 100;

            // Einzelne Kategorienberechnungen
            $this->foodQuality = $ratings->avg('food_quality');
            $this->service = $ratings->avg('service');
            $this->punctuality = $ratings->avg('punctuality');
            $this->price = $ratings->avg('price');
        } else {
            $this->overallRating = 0;
            $this->numberOfRatings = 0;
            $this->overallRatingProgress = null;

            // Einzelne Kategorienberechnungen
            $this->foodQuality = 0;
            $this->service = 0;
            $this->punctuality = 0;
            $this->price = 0;
        }
    }





    public function render()
    {
        $this->calculateOverallRating();
        return view('livewire.frontend.votings.rating-summary');
    }







}
