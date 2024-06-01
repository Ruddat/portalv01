<?php

namespace App\Livewire\Frontend\Votings;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ModSellerVotes;
use App\Models\ModSellerReplays;
use App\Models\ModSellerVotings;
use Illuminate\Support\Facades\Request;

class RatingList extends Component
{


    use WithPagination;

    public $shopId;
    public $overallRating;
    public $numberOfRatings;
    public $overallRatingProgress;
    public $foodQuality;
    public $service;
    public $punctuality;
    public $price;
    public $showReplyForm = false;

    public $replyAuthor;
    public $replyTitle;
    public $replyContent;
    public $ratingId;
    public $showReplyFormForRatingId;
    public $votingId;
    public $showRatings = false; // Startwert für die Anzeige der Bewertungen

    public function mount($shopId)
    {
        $this->shopId = $shopId;
        $this->calculateOverallRating();
      //  $this->votingId = $votingId;


    }

    public function toggleRatings()
    {
        $this->showRatings = !$this->showRatings; // Invertieren des aktuellen Werts
    }



    public function toggleReplyForm($ratingId)
    {
        $this->votingId = $ratingId;
        $this->showReplyForm = true;
        $this->showReplyFormForRatingId = $ratingId;

    }


    public function addReply()
    {
      //  dd($this->replyAuthor, $this->replyTitle, $this->replyContent);


        $this->validate([
            'replyAuthor' => 'required|string|max:255',
            'replyTitle' => 'required|string|max:255',
            'replyContent' => 'required|string',
        ]);

//dd($this->votingId, $this->replyAuthor, $this->replyTitle, $this->replyContent);


        ModSellerReplays::create([
            'voting_id' => $this->votingId,
      //      'voting_id' => '1', // Set the voting ID to 0
       'reply_author' => $this->replyAuthor,
            'reply_title' => $this->replyTitle,
            'reply_content' => $this->replyContent,
        ]);

        // Reset form fields
        $this->replyAuthor = '';
        $this->replyTitle = '';
        $this->replyContent = '';

        // Refresh the replays list
        $this->dispatch('replyAdded');
        $this->showReplyForm = false;

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


    public function like($ratingId)
    {
        $this->vote($ratingId, 'like');
    }

    public function dislike($ratingId)
    {
        $this->vote($ratingId, 'dislike');
    }

    protected function vote($ratingId, $type)
    {
        $identifier = Request::ip(); // You could also use a cookie or session identifier

        // Finde den vorhandenen Vote-Eintrag für den gegebenen identifier und ratingId
        $existingVote = ModSellerVotes::where('identifier', $identifier)->where('voting_id', $ratingId)->first();

        // Finde den Rating-Eintrag
        $orderHashEntry = ModSellerVotings::find($ratingId);

        // Überprüfe, ob der Rating-Eintrag existiert
        if ($orderHashEntry) {
            $orderHash = $orderHashEntry->order_hash;
            $shopId = $orderHashEntry->shop_id;

            // Überprüfen Sie, ob ein vorhandener Vote-Eintrag gefunden wurde
            if ($existingVote) {
                // Wenn der vorhandene Vote-Eintrag denselben Typ hat wie der übermittelte Typ, neutralisiere die Bewertung
                if ($existingVote->type === $type) {
                    if ($type === 'like' && $existingVote->likes_count > 0) {
                        $existingVote->decrement('likes_count');
                    } elseif ($type === 'dislike' && $existingVote->dislikes_count > 0) {
                        $existingVote->decrement('dislikes_count');
                    }
                    $existingVote->delete();
                } else {
                    // Andernfalls aktualisiere den Typ
                    if ($type === 'like') {
                        $existingVote->increment('likes_count');
                        if ($existingVote->dislikes_count > 0) {
                            $existingVote->decrement('dislikes_count');
                        }
                    } elseif ($type === 'dislike') {
                        $existingVote->increment('dislikes_count');
                        if ($existingVote->likes_count > 0) {
                            $existingVote->decrement('likes_count');
                        }
                    }
                    $existingVote->type = $type;
                    $existingVote->save();
                }
            } else {
                // Wenn kein vorhandener Vote-Eintrag existiert, erstelle einen neuen und aktualisiere den Zähler
                ModSellerVotes::create([
                    'shop_id' => $shopId,
                    'identifier' => $identifier,
                    'voting_id' => $ratingId,
                    'type' => $type,
                    'order_hash' => $orderHash,
                ]);

                // Behandeln Sie den Fall, wenn der Vote-Eintrag neu erstellt wurde
                $newVote = ModSellerVotes::where('identifier', $identifier)->where('voting_id', $ratingId)->first();
                if ($newVote) {
                    if ($type === 'like') {
                        $newVote->increment('likes_count');
                    } elseif ($type === 'dislike') {
                        $newVote->increment('dislikes_count');
                    }
                }
            }
        } else {
            // Der Eintrag mit der angegebenen voting_id wurde nicht gefunden
            // Füge hier entsprechenden Code hinzu, um damit umzugehen
        }

        $this->dispatch('ratingUpdated');
    }



    public function render()
    {
        $ratings = ModSellerVotings::where('shop_id', $this->shopId)
        ->orderBy('created_at', 'desc') // Sortiere nach dem neuesten Datum
        ->paginate(5);

        foreach ($ratings as $rating) {
            $rating->likes_count = $rating->votes()->where('type', 'like')->count();
            $rating->dislikes_count = $rating->votes()->where('type', 'dislike')->count();
        }

        return view('livewire.frontend.votings.rating-list', [
            'ratings' => $ratings,
        ]);
    }



}
