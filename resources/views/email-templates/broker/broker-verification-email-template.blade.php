<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willkommen bei [Deine Firma]</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #333333;
            font-size: 24px;
            margin: 0;
        }
        .content {
            padding: 20px;
            line-height: 1.5;
        }
        .content p {
            margin: 10px 0;
        }
        .content a {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            color: #777777;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Willkommen bei [Deine Firma], {{ $broker->firstname }}!</h1>
        </div>
        <div class="content">
            <p>Liebe/r {{ $broker->first_name }} {{ $broker->last_name }},</p>
            <p>Wir freuen uns sehr, dich als neues Mitglied in unserem Team begrüßen zu dürfen! Dein erster Schritt auf dem Weg zu neuen Möglichkeiten und Verdienstmöglichkeiten ist fast abgeschlossen.</p>
            <p>Um deinen Registrierungsprozess abzuschließen, bestätige bitte deine E-Mail-Adresse, indem du auf den untenstehenden Link klickst:</p>
            <p style="text-align: center;">
                <a href="{{ $verificationUrl }}">E-Mail-Adresse bestätigen</a>
            </p>
            <p>Nachdem du deine E-Mail-Adresse bestätigt hast, stehen dir alle Türen offen, um bei uns durchzustarten. Nur noch wenige Schritte, und schon kann das Geldverdienen losgehen!</p>
            <p>Falls du Fragen hast oder Unterstützung benötigst, zögere bitte nicht, uns zu kontaktieren. Wir sind hier, um dir zu helfen und sicherzustellen, dass dein Start bei uns reibungslos verläuft.</p>
            <p>Vielen Dank, dass du dich für [Deine Firma] entschieden hast. Wir freuen uns auf eine erfolgreiche Zusammenarbeit!</p>
        </div>
        <div class="footer">
            <p>Mit freundlichen Grüßen,</p>
            <p>Dein [Deine Firma] Team</p>
        </div>
    </div>
</body>
</html>
