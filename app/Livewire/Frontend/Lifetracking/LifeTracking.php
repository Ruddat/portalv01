<?php

namespace App\Livewire\Frontend\Lifetracking;

use Livewire\Component;
use App\Models\ModOrders;
use App\Services\CartService;
use App\Models\ModSellerVotings;
use App\Models\ModShop;
use Illuminate\Support\Facades\Session;

class LifeTracking extends Component
{
    public $orderHash;
    protected $cartService;

    public $latitude;
    public $longitude;
    public $option = ['ingo'];
    public $trackingNumber;
    public $shipmentStatus;
    public $order;
    public $trackshop;
    public $statusDescription;
    public $orderedArticles = [];
    public $votingStatus = false;
    public $starRating;
    public $shopData;

    public function mount($orderHash, CartService $cartService)
    {
        $this->trackingNumber = '';
        $this->shipmentStatus = null;
        $this->orderHash = $orderHash;
        $this->cartService = $cartService;

        $this->fetchOrder();
    }

    public function fetchOrder()
    {
        $order = ModOrders::where('hash', $this->orderHash)->first();

        $shopData = ModShop::where('id', $order->parent)->first();

        $this->shopData = $shopData;

        if ($order) {
            $this->order = $order;
            $this->latitude = $order->shipping_lat;
            $this->longitude = $order->shipping_lng;

            // Simuliere die Bewegung, indem du zufällige Offsets hinzufügst
            $this->latitude += $this->getRandomOffset();
            $this->longitude += $this->getRandomOffset();

            // Annahme: trackshop wird auf einen statischen Wert gesetzt. Dies sollte dynamisch basierend auf $order->parent sein.
            $this->trackshop = ['lat' => $this->latitude, 'lng' => $this->longitude];

            $this->statusDescription = $this->getStatusDescription($order->order_tracking_status);

            $this->votingStatus = $this->canBeRated($order->hash);

            $this->starRating = $this->getOverallVoting($order->parent);

            $orderData = json_decode($order->order_json_data, true);

            if (isset($orderData['OrderList']['Order']['ArticleList']['Article'])) {
                $articles = $orderData['OrderList']['Order']['ArticleList']['Article'];

                // SubArticleList immer als Array behandeln
                foreach ($articles as &$article) {
                    if (isset($article['SubArticleList']['SubArticle'])) {
                        $subArticles = $article['SubArticleList']['SubArticle'];
                        $article['SubArticleList'] = is_array($subArticles) ? $subArticles : [$subArticles];
                    } elseif (isset($article['SubArticleList']) && !is_array($article['SubArticleList'])) {
                        // Falls SubArticleList existiert, aber kein Array ist, in ein Array umwandeln
                        $article['SubArticleList'] = [$article['SubArticleList']];
                    } elseif (!isset($article['SubArticleList'])) {
                        // Falls SubArticleList nicht vorhanden ist, ein leeres Array zuweisen
                        $article['SubArticleList'] = [];
                    }
                }

                // Die vorbereiteten Artikel in die Eigenschaft $orderedArticles setzen
                $this->orderedArticles = $articles;
            }

            $this->dispatch('trackingStatusUpdated', $this->latitude, $this->longitude);
        } else {
            // Order nicht gefunden, eventuell eine Fehlermeldung setzen
            $this->order = null;
            session()->flash('error', 'Order not found.');
        }
    }

    public function fetchTrackingStatus()
    {
        $this->fetchOrder();
    }

    private function getRandomOffset($range = 0.0001)
    {
        return mt_rand(-$range * 10000, $range * 10000) / 10000;
    }

    public function canBeRated($voting)
    {
        $votingStatusHash = ModSellerVotings::where('order_hash', $this->orderHash)->first();

        $votingStatus = false;

        if ($votingStatusHash) {
            $votingStatus = true; //Bewertung bereits vorhanden
        }

//dd($votingStatus);

        return $votingStatus;
    }

    private function convertRatingToStars($rating)
    {
        return round($rating / 2, 1); // Bewertung von 1-10 auf eine 5-Sterne-Skala umrechnen und auf eine Nachkommastelle runden
    }

    public function getOverallVoting($shopId)
    {
        $overallVotings = ModShop::where('id', $shopId)->first();

        if (!$overallVotings || $overallVotings->voting_average === null) {
            return null; // Rückgabe null, wenn keine Bewertungen vorhanden sind
        }

        $votingAverrange = $overallVotings->voting_average;

        // Konvertiere die Bewertung in eine 5-Sterne-Bewertung
        $starRating = $this->convertRatingToStars($votingAverrange);
        return $starRating;
    }

    private function getStatusDescription($status)
    {
        switch ($status) {
            case 99999:
                return 'Bestellung wird gerade angenommen';
            case 0:
                return 'Bestellung wird gerade angenommen';
            case 1:
                return 'Bestellung wird gerade angenommen';
            case 2:
                return 'Bestellung gespeichert und in Zubereitung';
            case 3:
                return 'Küche';
            case 4:
                return 'Ofen';
            case 5:
                return 'Bestellung in Auslieferung';
            case 6:
                return 'Bestellung wurde geliefert';
            case 7:
                return 'Bestellung gelöscht';
            case 8:
                return 'Bestellung wurde rückerstattet';
            case 9:
                return 'Annahme der Bestellung ist fehlgeschlagen';
            case 10:
                return 'Bestellung wurde manuell storniert';
            case 11:
                return 'Anderer Grund (nicht angegeben)';
            default:
                return 'Unbekannter Status';
        }
    }

    public function render()
    {
        return view('livewire.frontend.lifetracking.life-tracking', [
            'order' => $this->order,
            'trackshop' => $this->trackshop,
            'statusDescription' => $this->statusDescription,
            'orderedArticles' => $this->orderedArticles,
            'starrating' => $this->starRating,
            'shopData' => $this->shopData,
        ]);
    }
}
