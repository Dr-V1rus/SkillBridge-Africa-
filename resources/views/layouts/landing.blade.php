<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SkillBridge Africa') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg?v=2') }}">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Alertify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }
    </style>
</head>

<body class="bg-white">
    <x-layout.navbar />

    <main>
        @yield('content')
    </main>

    <x-layout.footer />

    <!-- Alertify JS -->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        alertify.defaults.position = "top-right";
        alertify.defaults.transition = "slide";
        alertify.defaults.glossary = false;
        alertify.defaults.notification = {
            delay: 5,
            close: true
        };

        @if(session('success'))
            alertify.success('{{ session('success') }}');
            {{ session()->forget('success') }}
        @endif

        @if(session('error'))
            alertify.error('{{ session('error') }}');
            {{ session()->forget('error') }}
        @endif
    </script>
</body>

</html>