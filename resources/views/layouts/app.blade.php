<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased text-neutral-800">

    @yield('content')

    <footer class="bg-red-500 p-6 font-medium">
        <h3 class="text-2xl mt-4">Partneri projektu</h3>

        <div class="flex flex-wrap gap-6 mt-8">
            <img src="https://placeholder.pics/svg/108x32/DEDEDE/555555/logo">
            <img src="https://placeholder.pics/svg/188x32/DEDEDE/555555/logo">
            <img src="https://placeholder.pics/svg/80x32/DEDEDE/555555/logo">
            <img src="https://placeholder.pics/svg/32x40/DEDEDE/555555/logo">
        </div>

        <h3 class="text-2xl mt-4">Sociálne siete</h3>
        <ul class="underline flex flex-col gap-y-4 mt-4 text-sm">
            <li><a href="TODO">Instagram</a></li>
            <li><a href="TODO">Facebook</a></li>
            <li><a href="TODO">YouTube</a></li>
            <li><a href="TODO">Soundcloud</a></li>
        </ul>

        <div class="flex gap-x-4 text-sm mt-6">
            <span>Copyright © 2022 GMB</span>
            <span>Vytvoril <a href="TODO" class="underline">lab.SNG</a></span>
        </div>
    </footer>
</body>

</html>
