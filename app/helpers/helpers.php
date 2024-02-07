<?php

use App\Models\SocialNetwork;
use App\Models\GeneralSettings;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


/** SEND EMAIL FUNCTION USING PHPMAILER LIBRARY */
if( !function_exists('send_mail')){

    function sendEmail($mailConfig){

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

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
                'site_name' => 'PizzaPortal Dev',
                'site_email' => 'info@pizzaportal.com',
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
}
