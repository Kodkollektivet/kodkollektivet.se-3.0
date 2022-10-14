<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
        <link rel="stylesheet" href="/public/css/app.css">

        <script src="/public/js/jquery.min.js"></script>
        <script src="/public/js/app.js" defer></script>
        <script type="text/javascript" charset="UTF-8" src="//cdn.cookie-script.com/s/f6408903534b93a57f4d3b585ac0739c.js"></script>
        
        <style>
            a[disabled] {
                pointer-events: none;
                cursor: default;
                filter: opacity(0.5);
                -webkit-filter: opacity(0.5);
                -moz-filter: opacity(0.5);
            }
        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-base-300" i>

            <main>
                {{ $slot }}
            </main>

        </div>
    </body>
</html>
