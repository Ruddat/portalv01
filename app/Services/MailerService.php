<?php

namespace App\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Repositories\TranslationRepository;

class MailerService
{
    protected $autoTranslationService;

    // Füge den AutoTranslationService über Dependency Injection hinzu
    public function __construct(AutoTranslationService $autoTranslationService)
    {
        $this->autoTranslationService = $autoTranslationService;
    }

    public function sendEmail($to, $subject, $body, $locale = 'de')
    {
        $mail = new PHPMailer(true);

        // Übersetze Betreff und Inhalt
        $subject = $this->autoTranslationService->trans($subject, $locale);
        $body = $this->autoTranslationService->trans($body, $locale);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = false; // Setze auf false für MailDev
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port = env('MAIL_PORT');

            // Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject; // Verwende die übersetzte Betreffzeile
            $mail->Body = $body; // Verwende den übersetzten Inhalt

            // Set UTF-8 encoding
            $mail->CharSet = 'UTF-8'; // Setze die Zeichenkodierung auf UTF-8

            $mail->send();
            return true;
        } catch (Exception $e) {
            // Debug output for exceptions
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}
