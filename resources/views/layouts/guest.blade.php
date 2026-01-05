@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="w-full max-w-md bg-slate-900/50 border border-white/10 rounded-2xl p-8 shadow-xl">
            {{ $slot }}
        </div>
    </div>
</body>
</html>