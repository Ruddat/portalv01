<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\ModTopRankPrice;
use App\Models\ModShop;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        Log::info('NotifyOutbidUsers command started at ' . now());

        $outbidShops = ModTopRankPrice::query()
            ->join('mod_top_rank_prices as mt2', function ($join) {
                $join->on('mod_top_rank_prices.shop_id', '=', 'mt2.shop_id')
                     ->on('mod_top_rank_prices.original_rank', '<', 'mt2.rank');
            })
            ->join('mod_shops', 'mod_top_rank_prices.shop_id', '=', 'mod_shops.id')
            ->where('mod_top_rank_prices.notify_on_outbid', true)
            ->whereNull('mod_top_rank_prices.deleted_at')
            ->whereNull('mt2.deleted_at')
            ->where('mod_top_rank_prices.end_time', '>=', now())
            ->select([
                'mod_top_rank_prices.shop_id',
                'mod_top_rank_prices.original_rank',
                'mt2.rank',
                'mod_top_rank_prices.current_price',
                'mt2.current_price',
                'mod_shops.email',
                'mod_shops.title',
                'mod_shops.owner'
            ])
            ->distinct()
            ->get();

        Log::info('Found ' . $outbidShops->count() . ' shops to notify.');

        foreach ($outbidShops as $shop) {
            // Ermitteln Sie den höchsten Preis der anderen Shops in einer einzigen Abfrage
            $highestPrice = ModTopRankPrice::where('shop_id', '!=', $shop->shop_id)
                ->max('current_price');

            // Berechnen Sie den neuen Preis, der den höchsten Preis überschreitet
            $newPrice = $highestPrice + 0.10;

            // Debugging: Loggen Sie den neuen Preis
            Log::info('Calculated new price: ' . $newPrice);

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
            Log::info('Email data: ' . json_encode($data));

            // Sende die E-Mail mit PHPMailer
            $this->sendEmail($shop, $data);
        }

        Log::info('NotifyOutbidUsers command completed at ' . now());
    }

private function sendEmail($shop, $data)
{
    $mail = new PHPMailer(true);

    try {
        // Server-Einstellungen
        $mail->isSMTP();
        $mail->Host = config('mail.mailers.smtp.host');
        $mail->SMTPAuth = true;
        $mail->Username = config('mail.mailers.smtp.username');
        $mail->Password = config('mail.mailers.smtp.password');
        $mail->SMTPSecure = config('mail.mailers.smtp.encryption');
        $mail->Port = config('mail.mailers.smtp.port');

        // Absender und Empfänger
        $mail->setFrom(config('mail.from.address'), config('mail.from.name'));
        $mail->addAddress($shop->email, $shop->title);

        // E-Mail-Inhalt
        $mail->isHTML(true);
        $mail->Subject = 'Ihr Gebot wurde überboten';
        $mail->Body = view('email-templates.seller.outbid-notification', $data)->render();

        $mail->send();
        Log::info('Email sent successfully to shop ID: ' . $shop->shop_id);
    } catch (Exception $e) {
        Log::error('Failed to send email to shop ID: ' . $shop->shop_id . ' - ' . $mail->ErrorInfo);
    }
}
}
