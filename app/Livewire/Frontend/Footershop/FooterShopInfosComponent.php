<?php

namespace App\Livewire\Frontend\Footershop;

use Livewire\Component;
use App\Models\ModShop;
use App\Models\ModSellerWorktimes;
use App\Models\ModSysNewsletter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscriptionConfirmation;

class FooterShopInfosComponent extends Component
{
    public $shopId;
    public $shop;
    public $worktimes;
    public $currentDay;
    public $email;
    public $name;
    public $subscriptionSuccess = false;

    public function mount($shopId)
    {
        $this->shopId = $shopId;
        $this->currentDay = strtolower(Carbon::now()->format('l'));
    }

    public function render()
    {
        // Shop-Informationen abrufen
        $this->shop = ModShop::find($this->shopId);
        if (!$this->shop) {
            // Fehlerbehandlung, wenn der Shop nicht gefunden wird
            abort(404, 'Shop nicht gefunden');
        }

        // Öffnungszeiten abrufen und gruppieren
        $this->worktimes = ModSellerWorktimes::where('shop_id', $this->shopId)
            ->orderBy('day_of_week')
            ->get()
            ->groupBy('day_of_week')
            ->map(function ($worktimes) {
                $openTimes = $worktimes->filter(function ($worktime) {
                    return $worktime->is_open;
                })->map(function ($worktime) {
                    return [
                        'open_time' => $worktime->open_time,
                        'close_time' => $worktime->close_time,
                    ];
                });

                if ($openTimes->isEmpty()) {
                    return 'geschlossen';
                }

                return $openTimes;
            });

        // Sortieren nach Wochentagen
        $this->worktimes = $this->sortWorktimes($this->worktimes);

        return view('livewire.frontend.footershop.footer-shop-infos-component', [
            'shop' => $this->shop,
            'worktimes' => $this->worktimes,
            'currentDay' => $this->currentDay,
        ]);
    }

    private function sortWorktimes($worktimes)
    {
        $sortedWorktimes = [];
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($daysOfWeek as $day) {
            if (isset($worktimes[$day])) {
                $sortedWorktimes[$day] = $worktimes[$day];
            } else {
                $sortedWorktimes[$day] = 'geschlossen';
            }
        }

        return $sortedWorktimes;
    }

    public function subscribe()
    {
        $this->validate([
            'email' => 'required|email|unique:mod_sys_newsletters,email',
            'name' => 'nullable|string',
        ]);

        // Newsletter-Anmeldung speichern
        $newsletter = new ModSysNewsletter();
        $newsletter->email = $this->email;
        $newsletter->name = $this->name;
        $newsletter->shop_id = $this->shopId;
        $newsletter->save();

        // Bestätigungsmail senden
        Mail::to($this->email)->send(new NewsletterSubscriptionConfirmation($this->shop));

        // Dankesmeldung anzeigen
        $this->subscriptionSuccess = true;
    }
}
