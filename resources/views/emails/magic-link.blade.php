<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Link logowania - Global Synlogia</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f9fafb;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background-color: #124f9e;
            padding: 40px 30px;
            text-align: center;
        }
        .header img {
            max-height: 60px;
            width: auto;
        }
        .content {
            padding: 40px 30px;
        }
        .content h1 {
            color: #124f9e;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .content p {
            color: #374151;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .login-button {
            display: block;
            width: 100%;
            max-width: 300px;
            margin: 30px auto;
            background-color: #de244b;
            color: #ffffff;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }
        .login-button:hover {
            background-color: #b91c3c;
        }
        .security-info {
            background-color: #f3f4f6;
            border-left: 4px solid #124f9e;
            padding: 20px;
            margin: 30px 0;
        }
        .security-info h3 {
            color: #124f9e;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .security-info p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            color: #9ca3af;
            font-size: 14px;
            margin: 5px 0;
        }
        .footer a {
            color: #de244b;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('logo-white.png') }}" alt="Global Synlogia" style="filter: brightness(0) invert(1);">
        </div>

        <!-- Content -->
        <div class="content">
            <h1>Twój link logowania jest gotowy</h1>

            <p>Cześć!</p>

            <p>Otrzymujesz ten email, ponieważ poprosiłeś o link logowania do panelu klienta Global Synlogia.</p>

            <p>Kliknij poniższy przycisk, aby zalogować się bezpiecznie do swojego konta:</p>

            <a href="{{ route('auth.verify', $magicLink->token) }}" class="login-button">
                🔒 Zaloguj się do panelu
            </a>

            <div class="security-info">
                <h3>🛡️ Informacje o bezpieczeństwie</h3>
                <p><strong>• Link jest ważny przez 15 minut</strong> - po tym czasie wygaśnie</p>
                <p><strong>• Link może być użyty tylko raz</strong> - po kliknięciu zostanie dezaktywowany</p>
                <p><strong>• Nie udostępniaj tego linku nikomu</strong> - daje dostęp do Twojego konta</p>
            </div>

            <p>Jeśli nie prosiłeś o ten link, po prostu zignoruj ten email. Twoje konto pozostanie bezpieczne.</p>

            <p>
                Pozdrawiam,<br>
                <strong>Zespół Global Synlogia</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                <strong>Global Synlogia</strong><br>
                ul. Władysława Jagiełły 2/20, 80-180 Gdańsk<br>
                <a href="mailto:kontakt@globalsynlogia.com">kontakt@globalsynlogia.com</a> | +48 663 583 950
            </p>
            <p>
                <a href="{{ url('/') }}">globalsynlogia.com</a>
            </p>
            <p style="font-size: 12px; color: #9ca3af; margin-top: 20px;">
                Ten email został wysłany automatycznie. Nie odpowiadaj na tę wiadomość.
            </p>
        </div>
    </div>
</body>
</html>