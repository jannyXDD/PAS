@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 text-slate-100 antialiased">
    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="w-full max-w-md bg-slate-800/90 border border-slate-700 rounded-2xl p-8 shadow-xl">
            {{ $slot }}
        </div>
    </div>
</body>
</html>