<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" translate="no">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stevie McComb</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://kit.fontawesome.com" crossorigin>
    <script src="https://kit.fontawesome.com/053a145fda.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    @stack('styles')
</head>
<body>
    <div id="app" class="app"></div>

    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            config: {
                services: {
                    google: {
                        recaptcha: {
                            site_key: '{{ config('services.google.recaptcha.site_key') }}',
                        },
                    },
                },
            },
        };
        window.User = JSON.parse('<?php echo auth()->check() ? auth()->user()->toJson() : 'null'; ?>');
    </script>
    @vite('resources/js/app.js')
</body>
</html>
