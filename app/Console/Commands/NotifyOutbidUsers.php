<?php

namespace App\Console\Commands;
use constGuards;
use constDefaults;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotifyOutbidUsers extends Command
{
    protected $signature = 'notify:outbid';
    protected $description = 'Benachrichtigen Sie Benutzer, wenn ihre Gebote überboten wurden';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info('NotifyOutbidUsers command started at ' . now());

        $outbidShops = DB::table('mod_top_rank_prices as mt1')
        ->join('mod_top_rank_prices as mt2', function ($join) {
            $join->on('mt1.shop_id', '=', 'mt2.shop_id')
                 ->on('mt1.original_rank', '<', 'mt2.rank'); // Vergleich des ursprünglichen Ranges
        })
        ->join('mod_shops as ms', 'mt1.shop_id', '=', 'ms.id') // Join mit der mod_shops Tabelle
        ->where('mt1.notify_on_outbid', true) // Nur die, die benachrichtigt werden möchten
       // ->where('mt1.current_price', '<', 'mt2.current_price') // Preisvergleich
        ->whereNull('mt1.deleted_at')
        ->whereNull('mt2.deleted_at')
        ->where('mt1.end_time', '>=', now()) // Überprüfen, ob das Gebot noch gültig ist
        ->select('mt1.shop_id', 'mt1.original_rank', 'mt2.rank', 'mt1.current_price', 'mt2.current_price', 'ms.email', 'ms.title', 'ms.owner')
        ->distinct()
        ->get();

    \Log::info('Found ' . $outbidShops->count() . ' shops to notify.');


    foreach ($outbidShops as $shop) {
        // Ermitteln Sie den höchsten Preis der anderen Shops
        $highestPrice = DB::table('mod_top_rank_prices')
            ->where('shop_id', '!=', $shop->shop_id)
            ->max('current_price');

        // Berechnen Sie den neuen Preis, der den höchsten Preis überschreitet
        $newPrice = $highestPrice + 0.10;

        // Debugging: Loggen Sie den neuen Preis
        \Log::info('Calculated new price: ' . $newPrice);

        $data = [
            'shop' => $shop->shop_id,
            'original_rank' => $shop->original_rank,
            'new_rank' => $shop->rank,
            'original_price' => $shop->current_price,
            'new_price' => $newPrice, // Neuer Preis für die E-Mail
            'shop_title' => $shop->title, // Titel des Shops
            'shop_owner' => $shop->owner, // Eigentümer des Shops
        ];

        // Debugging: Ausgabe der E-Mail-Daten
        \Log::info('Email data: ' . json_encode($data));

        $email_body = view('email-templates.seller.outbid-notification', $data)->render();

        $mailConfig = [
            'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
            'mail_from_name' => custom_env('MAIL_FROM_NAME'),
            'mail_recipient_email' => $shop->email, // E-Mail-Adresse des Shops
            'mail_recipient_name' => $shop->title, // Name des Shops
            'mail_subject' => 'Ihr Gebot wurde überboten',
            'mail_body' => $email_body
        ];

        if (sendEmail($mailConfig)) {
            \Log::info('Email sent successfully to shop ID: ' . $shop->shop_id);
        } else {
            \Log::error('Failed to send email to shop ID: ' . $shop->shop_id);
        }
    }

    Log::info('NotifyOutbidUsers command completed at ' . now());

    }

}
