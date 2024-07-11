<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willkommen bei [Deine Firma]</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff;">
        <header style="text-align: center; padding-bottom: 20px;">
            <h1 style="color: #333333;">Willkommen bei [Deine Firma], {{ $broker->firstname }}!</h1>
        </header>
        <section style="padding: 20px; color: #333333; line-height: 1.5;">
            <p>Liebe/r {{ $broker->first_name }} {{ $broker->last_name }},</p>
            <p>Wir freuen uns sehr, dich als neues Mitglied in unserem Team begrüßen zu dürfen! Dein erster Schritt auf dem Weg zu neuen Möglichkeiten und Verdienstmöglichkeiten ist fast abgeschlossen.</p>
            <p>Um deinen Registrierungsprozess abzuschließen, bestätige bitte deine E-Mail-Adresse, indem du auf den untenstehenden Link klickst:</p>
            <p style="text-align: center;">
                <a href="{{ $verificationUrl }}" style="display: inline-block; padding: 10px 20px; color: #ffffff; background-color: #007bff; text-decoration: none; border-radius: 5px;">E-Mail-Adresse bestätigen</a>
            </p>
            <p>Nachdem du deine E-Mail-Adresse bestätigt hast, stehen dir alle Türen offen, um bei uns durchzustarten. Nur noch wenige Schritte, und schon kann das Geldverdienen losgehen!</p>
            <p>Falls du Fragen hast oder Unterstützung benötigst, zögere bitte nicht, uns zu kontaktieren. Wir sind hier, um dir zu helfen und sicherzustellen, dass dein Start bei uns reibungslos verläuft.</p>
            <p>Vielen Dank, dass du dich für [Deine Firma] entschieden hast. Wir freuen uns auf eine erfolgreiche Zusammenarbeit!</p>
        </section>
        <footer style="text-align: center; padding-top: 20px; color: #777777;">
            <p>Mit freundlichen Grüßen,</p>
            <p>Dein [Deine Firma] Team</p>
        </footer>
    </div>
</body>
</html>
