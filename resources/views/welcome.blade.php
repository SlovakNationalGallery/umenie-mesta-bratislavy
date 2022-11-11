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
    <div class="p-4 bg-neutral-100">
        <div class="p-4 border rounded-lg border-neutral-800 flex flex-col">
            <h1 class="text-2xl text-center">
                <span class="font-medium">Umenie</span>
                mesta
                <span class="font-medium">Bratislavy</span>
            </h1>
            <nav>
                <ul class="text-lg flex justify-around mt-4 font-medium">
                    <li>
                        <a href="TODO">O projekte</a>
                    </li>
                    <li>
                        <a href="TODO">Mapa a katalóg diel</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="mt-4 relative">
            <img src="https://placeholder.pics/svg/300/DEDEDE/555555/mapa" class="w-full">
            <div class="absolute inset-0 flex justify-center items-center">
                <a href="TODO"
                    class="text-lg bg-neutral-800 text-white inline-flex items-center rounded-full px-4 py-2">
                    Objavte diela v okolí
                    {{-- TODO get right icon --}}
                    <x-icons.map-pin class="ml-1" />
                </a>
            </div>
        </div>
    </div>

    <section class="px-4">

        <h2 class="mt-10 text-3xl font-medium">
            Najnovšie diela <br class="sm:hidden" />
            v katalógu
        </h2>

        <div class="pt-2 pb-14">
            @php
                $comps = [['imgSrc' => 'https://picsum.photos/id/16/200/300'], ['imgSrc' => 'https://picsum.photos/id/17/300/200']];
            @endphp
            @foreach ($comps as $c)
                <a class="mt-8 block" href="TODO">
                    <img src="{{ $c['imgSrc'] }}" class="w-full rounded-2xl max-h-60 object-cover object-center">
                    <h4 class="text-2xl font-medium mt-2">Dievča s knihou</h4>
                    <span class="block text-sm">Michal Zdravecký</span>
                    <span class="block text-sm">1988&mdash;2015</span>
                </a>
            @endforeach
        </div>
    </section>
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

