<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\ModShop;
use App\Models\ModOrders;
use Illuminate\Support\Str;
use App\Services\MailerService;
use Illuminate\Console\Command;
use App\Models\ModAdminMarketingSetting;
use App\Models\MarketingCampaignParticipants;

class SendMarketingEmails extends Command
{
    protected $signature = 'marketing:send-emails';
    protected $description = 'Send marketing emails to customers who have not ordered for a while';

    public function handle(MailerService $mailerService)
    {
        // Sort settings by duration in descending order
        $settings = ModAdminMarketingSetting::orderByDesc('duration')->get();

        // Get all customers who have not ordered for any of the durations
        $allCustomers = ModOrders::select('email')
            ->where('subscribe_news', 1) // Nur Kunden, die Marketing-E-Mails erhalten möchten
            ->groupBy('email')
            ->get()
            ->pluck('email')
            ->toArray();

        $emailCount = 0; // Initialize email count

        foreach ($settings as $setting) {
            $durationInDays = $setting->duration;
            $discountPercentage = $setting->discount_percentage;
            $validityDays = $setting->validity_days; // Gültigkeit des Gutscheins in Tagen
            $usageLimit = $setting->usage_limit; // Wie oft der Gutschein verwendet werden kann

            // Get customers who have not ordered for the specified duration and subscribed to newsletters
            $customers = ModOrders::select('email', 'parent as shop_id', 'id as order_id') // id als order_id
                ->where('created_at', '<', Carbon::now()->subDays($durationInDays))
                ->where('subscribe_news', 1) // Nur Kunden, die Marketing-E-Mails erhalten möchten
                ->groupBy('email', 'shop_id', 'order_id')
                ->get();

            foreach ($customers as $customer) {
                // Set the validUntil variable to calculate the expiration date
                $validUntil = Carbon::now()->addDays($validityDays); // Definiere $validUntil

                // Check if the customer has received a discount for this setting or has an existing unused voucher
                $existingDiscount = MarketingCampaignParticipants::where('email', $customer->email)
                    ->where('shop_id', $customer->shop_id)
                    ->where('used', false)
                    ->where('valid_until', '>', Carbon::now()) // Noch gültiger Gutschein
                    ->first();

                // Gutscheincode setzen
                $voucherCode = $existingDiscount ? $existingDiscount->voucher_code : Str::upper(Str::random(10));

                if ($existingDiscount) {
                    // If a higher discount is now available, update the existing discount
                    if ($existingDiscount->discount_percentage < $discountPercentage) {
                        // Update the voucher code and other details
                        $existingDiscount->update([
                            'discount_percentage' => $discountPercentage,
                            'valid_until' => $validUntil, // Verwende die definierte Variable
                            'voucher_code' => $voucherCode, // Neuer Gutscheincode
                        ]);

                        // Optional: sende eine neue E-Mail mit den aktualisierten Details
                        $shop = ModShop::find($customer->shop_id);
                        if ($shop) {
                            $shopSlugOrId = $shop->shop_slug ?? $shop->id;
                            $shopDomain = \DB::table('mod_seller_domains')->where('shop_id', $shop->id)->value('domain') ?? config('app.url');

                            // Überprüfen, ob das Protokoll vorhanden ist, und falls nicht, füge "https://" hinzu
                            if (!preg_match("~^(?:f|ht)tps?://~i", $shopDomain)) {
                                $shopDomain = "https://" . $shopDomain;
                            }

                            // Erzeuge die Shop-URL mit dem Gutscheincode
                            $shopUrl = "{$shopDomain}/de/restaurant/{$shopSlugOrId}?voucher_code={$voucherCode}";

                            $emailSent = $mailerService->sendEmail(
                                $customer->email,
                                'We Miss You Again! Here\'s an Even Better Discount',
                                view('emails.marketing', [
                                    'discountPercentage' => $discountPercentage,
                                    'voucherCode' => $voucherCode,
                                    'shopTitle' => $shop->title,
                                    'shopUrl' => $shopUrl,
                                    'validUntil' => $validUntil, // Füge $validUntil hier hinzu
                                ])->render()
                            );

                            if ($emailSent) {
                                $this->info("Updated email sent to: {$customer->email}");
                                $emailCount++;
                            }
                        }
                    }
                } else {
                    // Generate a unique voucher code
                    $voucherCode = Str::upper(Str::random(10));

                    // Get shop details
                    $shop = ModShop::find($customer->shop_id);
                    if ($shop) {
                        $shopSlugOrId = $shop->shop_slug ?? $shop->id;
                        $shopDomain = \DB::table('mod_seller_domains')->where('shop_id', $shop->id)->value('domain') ?? config('app.url');

                        // Überprüfen, ob das Protokoll vorhanden ist, und falls nicht, füge "https://" hinzu
                        if (!preg_match("~^(?:f|ht)tps?://~i", $shopDomain)) {
                            $shopDomain = "https://" . $shopDomain;
                        }

                        // Erzeuge die Shop-URL mit dem Gutscheincode
                        $shopUrl = "{$shopDomain}/de/restaurant/{$shopSlugOrId}?voucher_code={$voucherCode}";

                        // Send email to the customer
                        $emailSent = $mailerService->sendEmail(
                            $customer->email,
                            'We Miss You! Here\'s a Special Discount',
                            view('emails.marketing', [
                                'discountPercentage' => $discountPercentage,
                                'voucherCode' => $voucherCode,
                                'shopTitle' => $shop->title,
                                'shopUrl' => $shopUrl,
                                'validUntil' => $validUntil, // Verwende die gültige Variable
                            ])->render()
                        );

                        if ($emailSent) {
                            // Log the participation
                            MarketingCampaignParticipants::create([
                                'email' => $customer->email,
                                'marketing_setting_id' => $setting->id,
                                'shop_id' => $customer->shop_id,
                                'voucher_code' => $voucherCode,
                                'valid_until' => $validUntil,
                                'discount_percentage' => $discountPercentage,
                                'used' => false,
                                'order_id' => $customer->order_id, // Hier die order_id speichern
                            ]);

                            $this->info("Email sent to: {$customer->email}");
                            $emailCount++;
                        }
                    } else {
                        $this->error("Shop not found for shop_id: {$customer->shop_id}");
                    }
                }

                // Stop if the email limit is reached
                if ($emailCount >= 100) {
                    $this->info('Email limit reached. Stopping email sending.');
                    return;
                }
            }
        }

        $this->info('Marketing emails sent successfully.');
    }
}
