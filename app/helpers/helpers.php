<?php

use Dotenv\Dotenv;
use App\Models\SocialNetwork;
use App\Models\GeneralSettings;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


/** SEND EMAIL FUNCTION USING PHPMAILER LIBRARY */
if( !function_exists('send_mail')){

    function sendEmail($mailConfig){

        require_once public_path('PHPMailer/src/Exception.php');
        require_once public_path('PHPMailer/src/PHPMailer.php');
        require_once public_path('PHPMailer/src/SMTP.php');

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                                        // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = env('EMAIL_HOST');                     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = env('EMAIL_USERNAME');                     // SMTP username
    $mail->Password   = env('EMAIL_PASSWORD');                               // SMTP password
    $mail->SMTPSecure = env('EMAIL_ENCRYPTION');         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = env('EMAIL_PORT');                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->setFrom($mailConfig['mail_from_email'], $mailConfig['mail_from_name']);
    $mail->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']); // Add a recipient
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $mailConfig['mail_subject'];
    $mail->Body    = $mailConfig['mail_body'];


            // Setze die Zeichenkodierung
            $mail->CharSet = 'UTF-8';

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }


    }

}

/** GET GENERAL SETTINGS */

if( !function_exists('get_settings')){

    function get_settings(){
        $results = null;
        $settings = new GeneralSettings();
        $settings_data = $settings->first();

        if($settings_data){
            $results = $settings_data;
        }else{
            $settings->insert([
                'site_name' => 'Mamas Express',
                'site_email' => 'info@mamasexpress.com',
                'paypal_express_fee_fixed' => 0.39, // Beispielwert
                'paypal_express_fee_percentage' => 2.99, // Beispielwert
                'emergency_sms_cost' => 0.59, // Beispielwert
                'service_fee_non_paypal' => 0.59, // Beispielwert
                'instant_payout_fee_percentage' => 0.5, // Beispielwert
                'sales_commission' => 8.00, // Beispielwert
                'company_name' => 'Mamas Express',
                'address' => 'Rebenring 18',
                'postal_code' => '38118',
                'city' => 'Braunschweig',
                'country' => 'Deutschland',
                'ceo_name' => 'Ingo Ruddat',
                'phone' => '+49',
                'bank_name' => 'Commerzbank',
                'iban' => 'xxxxxxxxxx',
                'register_court' => 'Amtsgericht Braunschweig',
                'hrb' => 'HRB',
                'vat_number' => 'USt.-Nr. DE'

            ]);
            $new_settings_data = $settings->first();
            $results = $new_settings_data;
        }

        return $results;
    }

    /** get social networks */

    if(!function_exists('get_social_network')) {
        function get_social_network(){
            $results = null;
            $social_network = new SocialNetwork();
            $social_network_data = $social_network->first();

            if($social_network_data){
                $results = $social_network_data;

            }else{
                $social_network->insert([
                    'facebook_url' => null,
                    'twitter_url' => null,
                    'instagram_url' => null,
                    'linkedin_url' => null,
                    'tiktok_url' => null,
                    'youtube_url' => null,
                    'whatsapp_number' => null,
                    'printerest_url' => null,
                    'github_url' => null,
                    'telegram_url' => null,
                    'snapchat_url' => null,
                    'twitch_url' => null,
                ]);
                $new_social_network_data = $social_network->first();
                $results = $new_social_network_data;
            }

            return $results;
        }

    }

    if (!function_exists('custom_env')) {
        /**
         * Gets the value of an environment variable.
         *
         * @param  string  $key
         * @param  mixed  $default
         * @return mixed
         */
        function custom_env($key, $default = null)
        {
            $envFilePath = base_path('.env');
            $dotenv = Dotenv::createImmutable(dirname($envFilePath), basename($envFilePath));
            $dotenv->load();

            return $_ENV[$key] ?? $default;
        }
    }

    if (!function_exists('word_wrap')) {
        function word_wrap($string, $limit = 6) {
            $words = explode(' ', $string);
            $output = [];
            $line = '';

            foreach ($words as $word) {
                if (str_word_count($line . ' ' . $word) > $limit) {
                    $output[] = trim($line);
                    $line = $word;
                } else {
                    $line .= ' ' . $word;
                }
            }

            $output[] = trim($line);

            return implode('<br>', $output);
        }
    }

    // ----------------------------------------------------------------
    // Generate unique shop number
    if (!function_exists('generateCopyUniqueShopNumber')) {
        function generateCopyUniqueShopNumber($prefix = '')
        {
            $timestamp = now()->format('ymdHi');
            $randomNumber = mt_rand(10, 99);

            if (!empty($prefix)) {
                return sprintf('%s-%s-%s', $prefix, $timestamp, $randomNumber);
            } else {
                return sprintf('%s-%s', $timestamp, $randomNumber);
            }
        }
    }



}
