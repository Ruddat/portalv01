<?php

namespace App\Livewire\Frontend\Votings;

use App\Models\ModShop;
use Livewire\Component;
use App\Models\ModOrders;
use Illuminate\Http\Request;
use App\Models\ModSellerVotings;

class VotingsRestaurant extends Component
{


    public $order;
    public $restaurant;
    public $review_title;
    public $review_content;
    public $food_quality_val = 0;
    public $service_val = 0;
    public $price_val = 0;
    public $delivery_time_val = 0;
    public $agb_accepted;

    public function mount($orderHash)
    {
        // Bestellung anhand der Order-Hash-ID abrufen
        $this->order = ModOrders::where('hash', $orderHash)->first();

        // Wenn keine Bestellung mit dieser Order-Hash-ID gefunden wurde, zurück zur Homepage
        if (!$this->order) {
            return redirect()->route('index');
        }

        // Restaurant anhand der Shop-ID aus der Bestellung abrufen
        $this->restaurant = ModShop::findOrFail($this->order->parent);

    }





    public function submitReview(Request $request)
    {


        // Bewertung validieren
        $this->validate([
            'review_title' => 'required|min:5|max:100',
            'review_content' => 'required|min:10|max:1500',
            'food_quality_val' => 'required|integer|between:0,10',
            'service_val' => 'required|integer|between:0,10',
            'price_val' => 'required|integer|between:0,10',
            'delivery_time_val' => 'required|integer|between:0,10',
            'agb_accepted' => 'accepted',
        ],[
            'review_title.required' => 'Please enter a title for your review.',
            'review_title.min' => 'The title must be at least 5 characters long.',
            'review_title.max' => 'The title must not be longer than 100 characters.',
            'review_content.required' => 'Please enter a review text.',
            'review_content.min' => 'The review text must be at least 10 characters long.',
            'review_content.max' => 'The review text must not be longer than 1500 characters.',
            'food_quality_val.required' => 'Please rate the food quality.',
            'food_quality_val.integer' => 'The food quality rating must be a number.',
            'food_quality_val.between' => 'The food quality rating must be between 0 and 10.',
            'service_val.required' => 'Please rate the service.',
            'service_val.integer' => 'The service rating must be a number.',
            'service_val.between' => 'The service rating must be between 0 and 10.',
            'price_val.required' => 'Please rate the price.',
            'price_val.integer' => 'The price rating must be a number.',
            'price_val.between' => 'The price rating must be between 0 and 10.',
            'delivery_time_val.required' => 'Please rate the delivery time.',
            'delivery_time_val.integer' => 'The delivery time rating must be a number.',
            'delivery_time_val.between' => 'The delivery time rating must be between 0 and 10.',
            'agb_accepted.accepted' => 'Please accept our terms and conditions.',

        ]);


       // dd($request->all());


        // Bewertung verarbeiten (z.B. in der Datenbank speichern)
        $review = new ModSellerVotings;
        $review->order_id = $this->order->id;
        $review->shop_id = $this->restaurant->id;
        $review->order_hash = $this->order->hash;
        $review->review_title = $this->review_title;
        $review->review_content = $this->review_content;
        $review->food_quality = $this->food_quality_val;
        $review->service = $this->service_val;
        $review->price = $this->price_val;
        $review->punctuality = $this->delivery_time_val;
        $review->agb_accepted = $this->agb_accepted;
        // wenn kein Foto hochgeladen
        $review->published = 1;
        $review->save();



    // Bewertungen aus der Datenbank abrufen
    $votings = ModSellerVotings::where('shop_id', $this->restaurant->id)->get();

    // Anzahl der Bewertungen und Durchschnittswert berechnen
    $totalVotes = $votings->count();
    $totalFoodQuality = $votings->sum('food_quality');
    $totalService = $votings->sum('service');
    $totalPrice = $votings->sum('price');
    $totalPunctuality = $votings->sum('punctuality');

    // Den Durchschnittswert berechnen
    $votingAverage = ($totalFoodQuality + $totalService + $totalPrice + $totalPunctuality) / (4 * $totalVotes);

    // Shop-Daten aktualisieren
    $shop = ModShop::find($this->restaurant->id);
    $shop->votes_count = $totalVotes;
    $shop->voting_average = $votingAverage;
    $shop->save();



      //  dd($request->all());

        // Hier könntest du die eingereichten Daten validieren und in der Datenbank speichern

        // Erfolgsmeldung anzeigen oder Benutzer weiterleiten
        session()->flash('success', 'Your review has been submitted successfully!');
     //     return redirect()->route('home');
          return redirect()->route('detail-restaurant-2.index', ['restaurantId' => $this->restaurant->id]);
    }


    public function render()
    {
        return view('livewire.frontend.votings.votings-restaurant', [
            'order' => $this->order,
            'restaurant' => $this->restaurant,
        ]);
    }
}
