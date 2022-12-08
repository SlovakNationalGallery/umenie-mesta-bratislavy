@extends('layouts.app')

@section('content')
    <div class="bg-neutral-100">
        <div class="max-w-screen-3xl p-4 md:p-14 mx-auto md:flex">
            <h3 class="text-4xl font-medium md:w-2/5 flex-shrink-0">
                O projekte
            </h3>
            <div>
                <div class="prose mt-2 md:text-2xl">
                    <p>Databázu diel vo verejnom priestore ako svoj vedecko-výskumný projekt založila a spravuje
                        <strong> Galéria mesta Bratislavy </strong>. Od roku 2022 vzniká kurátorský výber diel, pričom
                        jednotlivé
                        informácie sa na pravidelnej ročnej báze dopĺňajú a aktualizujú. Postupne tak pribudnú diela
                        všetkých
                        piatich mestských okresov a sedemnástich samosprávnych mestských častí.
                    </p>
                    <p>Okrem existujúcich diel, sa mapujú aj fragmenty a diela presunuté, odstránené alebo zničené.</p>
                    <p>Ambíciou projektu je dynamická a otvorená databáza, ktorá sa bude pravidelne doplňovať
                        o nové poznatky z výskumu. Cieľom je aktualizovať a revidovať informácie z iných čiastkových
                        databáz a súpisov. Základným kritériom pre výber diel do databázy UVP GMB je tvorba
                        profesionálnych autorov (výtvarných umelcov, architektov, dizajnérov a súvisiacich odborov) z
                        obdobia po roku 1945, zastúpených v zbierkach GMB aj iných zbierkotvorných a výskumných
                        inštitúcií. Pozornosť sa zameriava na najviac ohrozené diela, ktoré potrebujú ochranu a
                        odborné postupy pri údržbe a obnove. V ďalších rokoch je cieľom dopĺňať do databázy aj diela
                        zo starších období.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <section class="bg-white">
        <div class="max-w-screen-3xl p-4 md:p-14 mx-auto md:flex">
            <h3 class="text-4xl font-medium md:w-2/5 flex-shrink-0">
                Kategórie diel v katalógu
            </h3>
            <div>

                <div class="gap-x-6 grid gap-y-2 md:grid-rows-5 md:grid-flow-col flex-grow">
                    <div class="flex items-center text-2xl gap-x-6">
                        <x-icons.pins.pomnik class="w-12 h-12 flex-shrink-0" />
                        Pamätník
                    </div>
                    <div class="flex items-center text-2xl gap-x-6">
                        <x-icons.pins.pomnik class="w-12 h-12 flex-shrink-0" />
                        Pomník
                    </div>
                    <div class="flex items-center text-2xl gap-x-6">
                        <x-icons.pins.pomnik class="w-12 h-12 flex-shrink-0" />
                        Plastika, socha voľná
                    </div>
                    <div class="flex items-center text-2xl gap-x-6">
                        <x-icons.pins.pomnik class="w-12 h-12 flex-shrink-0" />
                        Fontána, studňa vodný prvok
                    </div>
                    <div class="flex items-center text-2xl gap-x-6">
                        <x-icons.pins.pomnik class="w-12 h-12 flex-shrink-0" />
                        Dielo do architektúry
                    </div>
                    <div class="flex items-center text-2xl gap-x-6">
                        <x-icons.pins.pomnik class="w-12 h-12 flex-shrink-0" />
                        Drobná architektúra, dizajn, herný prvok
                    </div>
                    <div class="flex items-center text-2xl gap-x-6">
                        <x-icons.pins.pomnik class="w-12 h-12 flex-shrink-0" />
                        Pamätná tabuľa
                    </div>
                    <div class="flex items-center text-2xl gap-x-6">
                        <x-icons.pins.pomnik class="w-12 h-12 flex-shrink-0" />
                        Reliéf
                    </div>
                    <div class="flex items-center text-2xl gap-x-6">
                        <x-icons.pins.pomnik class="w-12 h-12 flex-shrink-0" />
                        Nové médiá, streetart, inštalácia
                    </div>
                </div>
                <div class="flex items-center text-2xl gap-x-6 mt-12">
                    <x-icons.pins.pomnik class="w-12 h-12 flex-shrink-0" />
                    Symbol označenia zničeného diela
                </div>
            </div>
        </div>

    </section>
@endsection

