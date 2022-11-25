@extends('layouts.app')

@section('content')
    <div class="p-4">
        <a href="{{ route('artworks.index') }}" class="mt-4 py-2 text-xs underline inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            <span class="x-ml-1">Späť na zoznam diel</span>
        </a>
        <h1 class="text-2xl font-medium mt-3">Pomník prof. Alexandra Húščavu</h1>
        <div class="mt-1">
            <a class="underline" href="TODO">Michal Zdravecký</a> / 1988
        </div>

        <div class="mt-6 flex space-x-2">
            <div class="bg-neutral-200 border-2 border-neutral-400 w-1/3 h-60"></div>
            <div class="bg-neutral-200 border-2 border-neutral-400 w-2/3 h-60"></div>
        </div>

        <article class="prose mt-6">
            <p>
                Pomník významného historika, archivára a pedagóga FFUK stojí v parčíku pri objekte predškolských zariadení,
                pôvodne sídla MÚ Lamač,
            </p>
            <p>
                Prof. Húščava ((1906 - 1969) bol rodákom y Lamača a prežil tu celý život. Počas svojej bohatej výskumnej
                práce
                sa venoval aj dejinám rodnej obce. Výskum zhrnul v knihe Dejiny Lamača (1. vyd. 1948, reed. 1998).
            </p>
            <p>
                Pomník má podobu siedmich žulových dosiek stupňovito usporiadaných do polkruhu. Na najvyššej doske je
                bronzová
                busta prof. Húščavu. Na najnižšej doske je jeho gravírovaný a zlátený podpis a roky 1906 - 1969. Dodatočne
                bola
                na dosku pripevnená striebristá tabuľka, ktorá svojím stvárnením, fontom písma a chybami v texte narúša
                pôvodný
                vzhľad pomníka.
            </p>
            <p>
                Prístup k pomníku pôvodne bol z menších kamenných platní osadených v trávniku. V súčasnosti sú nahradené
                masívnejším chodníkom zo zámkovej dlažby.
            </p>
        </article>

        <div class="flex gap-3 mt-4">
            @foreach (['pomnik', 'busta'] as $keyword)
                <a href="TODO" class="px-2 py-1 border border-neutral-800">{{ $keyword }}</a>
            @endforeach
        </div>

        <hr class="neutral-100 mt-6" />

        {{-- TODO: dynamically --}}
        <h4 class="font-medium mt-8">Autori</h4>
        <ul>
            @foreach (['Michal Zdravecký'] as $author)
                <li><a href="TODO" class="underline">{{ $author }}</a></li>
            @endforeach
        </ul>

        <h4 class="font-medium mt-5">Spoluautori</h4>
        <ul>
            @foreach (['Michal Zdravecký'] as $coauthor)
                <li><a href="TODO" class="underline">{{ $coauthor }}</a></li>
            @endforeach
        </ul>

        <hr class="neutral-100 mt-6" />

        <h4 class="font-medium mt-8">Roky</h4>
        <ul>
            @foreach (['1988 - realizácia', 'približne 2015 - úprava okoilia a nová tabuľka'] as $year)
                <li>{{ $year }}</li>
            @endforeach
        </ul>

        <hr class="neutral-100 mt-6" />

        <h4 class="font-medium mt-6">Druh</h4>
        <ul>
            @foreach (['pomník'] as $category)
                <li><a href="TODO" class="underline">{{ $category }}</a></li>
            @endforeach
        </ul>

        <h4 class="font-medium mt-6">Materiál</h4>
        {{ collect(['bronz', 'tehla'])->join(', ') }}

        <h4 class="font-medium mt-6">Technika</h4>
        {{ collect(['liatie', 'tesanie', 'gravírovanie'])->join(', ') }}

        <h4 class="font-medium mt-6">Rozmer</h4>
        busta v 45 cm, kamenné dosky v 160 - 220 cm, podstavec 94 x 92 x 10 cm

        <h4 class="font-medium mt-6">Signatúra</h4>
        nie je

        <h4 class="font-medium mt-6">Stav</h4>
        <ul>
            @foreach (['zachovaný, udržiavaný'] as $condition)
                <li>{{ $condition }}</li>
            @endforeach
        </ul>
        <div class="text-neutral-500 flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 mt-[0.15rem] mr-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>

            <span>nevhodné sekundárne doplnky, nápis slabo čitateľný</span>
        </div>
        <h4 class="font-medium mt-6">Evidovaná / Existujúci stupeň ochrany</h4>
        <ul>
            @foreach (['pamätihodnosť mestskej časti Petržálka '] as $condition)
                <li>{{ $condition }}</li>
            @endforeach
        </ul>

        <h4 class="font-medium mt-6">Vlastník</h4>
        <ul>
            @foreach (['m. č. Lamač'] as $owner)
                <li>{{ $owner }}</li>
            @endforeach
        </ul>
        <h4 class="font-medium mt-6">Správca</h4>
        <ul>
            @foreach (['m. č. Lamač'] as $maintainer)
                <li>{{ $maintainer }}</li>
            @endforeach
        </ul>

        <hr class="neutral-100 mt-6" />

        <h4 class="font-medium mt-6">Adresa</h4>
        Heyrovského 8, Petržálka; 841 03

        <h4 class="font-medium mt-6">Bližšie informácie o lokalite</h4>
        parčík medzi ul. Heyrovského a Studenohorská

        <h4 class="font-medium mt-6">GPS</h4>
        48.196569, 17.04794

        <h4 class="font-medium mt-6">Číslo parcely</h4>
        549/1 Hl. mesto Bratislava
    </div>
    <div class="mt-8 bg-neutral-200 border-2 border-neutral-400 h-80 flex items-center justify-center">mapa</div>
    <div class="pt-10 pb-6 px-4 bg-neutral-100">
        <h3 class="text-3xl font-medium mt-3">Ďalšie diela v okolí</h3>

        {{-- TODO --}}
        <div class="mt-4 -mx-4 px-4">
            <x-artwork-card :artwork="$artwork" />
        </div>
    </div>
@endsection
