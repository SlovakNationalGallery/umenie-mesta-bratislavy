@extends('layouts.app')

@section('content')
    <div class="max-w-screen-3xl p-4 md:p-14 mx-auto md:text-2xl md:flex">
        <h3 class="text-xl md:text-4xl font-medium md:w-2/5 flex-shrink-0">
            O projekte
        </h3>
        <div>
            <div class="prose mt-8 md:mt-2 md:text-2xl text-neutral-800">
                <p>
                    Databázu diel vo verejnom priestore ako svoj vedeckovýskumný projekt založila a spravuje <a
                        href="https://gmb.sk/" class="font-medium hover:no-underline" target="_blank">Galéria mesta
                        Bratislavy</a>. Kurátorský
                    výber diel vzniká od roku 2022, pričom jednotlivé informácie sa budú pravidelne dopĺňať a aktualizovať.
                    Postupne tak pribudnú diela všetkých <a
                        href="https://bratislava.sk/mesto-bratislava/sprava-mesta/mestske-casti"
                        class="font-medium hover:no-underline" target="_blank">piatich mestských
                        okresov a sedemnástich samosprávnych mestských častí</a>.
                </p>

                <p>Okrem diel existujúcich na pôvodných miestach sa mapujú aj fragmenty a diela presunuté, odstránené alebo
                    zničené v kategóriách:</p>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="max-w-screen-3xl p-4 md:p-14 mx-auto md:flex">
            <h3 class="text-xl md:text-4xl mt-6 md:mt-0 font-medium md:w-2/5 flex-shrink-0">
                Kategórie diel v katalógu
            </h3>
            <div class="text-xl md:text-2xl mt-8 md:mt-0">
                <div class="gap-x-6 grid gap-y-6 md:grid-rows-5 md:grid-flow-col flex-grow">
                    @foreach ($categories as $category)
                        <x-category-with-icon :icon="$category->icon"
                            :id="$category->id">{{ $category->name }}</x-category-with-icon>
                    @endforeach
                </div>
                <div class="flex items-center gap-x-4 md:gap-x-6 mt-16">
                    <x-icons.pins.defunct class="w-10 h-10 md:w-12 md:h-auto flex-shrink-0" />
                    Označenie zaniknutého diela
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-screen-3xl p-4 md:p-14 mx-auto md:text-2xl">
        <div class="md:flex">
            <div class="md:w-2/5 flex-shrink-0">
                {{-- TODO real data --}}
                <h4 class="text-lg md:text-3xl mt-6 md:mt-0 font-medium">
                    Aktuálne spracované dáta
                </h4>
                <div class="mt-8 md:mt-10 flex flex-col gap-y-6">
                    <div class="flex items-start gap-x-2">
                        <span class="text-4xl font-medium">{{ $stats['artworks'] }}</span>
                        <span class="leading-none mt-[0.15rem] text-base">diel<br /> v katalógu</span>
                    </div>
                    <div class="flex items-start gap-x-2">
                        <span class="text-4xl font-medium">{{ $stats['boroughs'] }}/17</span>
                        <span class="leading-none mt-[0.15rem] text-base">mestských<br />častí</span>
                    </div>
                    <div class="flex items-start gap-x-2">
                        <span class="text-4xl font-medium">
                            {{ optional($stats['lastUpdate'])->isoFormat('DD/MM/YY') }}
                        </span>
                        <span class="leading-none mt-[0.15rem] text-base">naposledy<br />aktualizované</span>
                    </div>
                </div>
            </div>
            <div class="mt-8 md:mt-0">
                <div class="prose mt-2 md:text-2xl text-neutral-800">
                    <p>
                        Cieľom je prezentovať a popularizovať pestrú škálu umenia vo verejnom priestore od 2. polovice
                        20.
                        storočia až po súčasnosť a priniesť čo najviac informácií o význame, okolnostiach vzniku a
                        príbehoch
                        diel, o ich autoroch, použitých materiáloch a výtvarných technikách. Zámerom takisto je získať
                        aktuálneúdaje o stave a presnom umiestnení diel, GPS súradniciach a o ich vlastníkoch a
                        správcoch. U
                        väčšiny diel vo verejnom priestore sú práve nejasné vlastnícke vzťahy príčinou chýbajúcej
                        starostlivosti a nevhodného zaobchádzania.
                    </p>

                    <p>
                        Údaje v databáze sú tvorené tak, aby iba bolo možné postupne prepájať na Web umenia a ďalšie
                        registre a katalógy zamerané napríklad na galerijné a múzejne zbierky, modernú architektúru,
                        národné
                        kultúrne pamiatky a na databázy diel vo verejnom priestore v iných mestách.
                    </p>

                    <p>
                        Projekt bol realizovaný vďaka finančnej podpore hlavného mesta SR Bratislava a Fondu na podporu
                        umenia.
                    </p>
                </div>
            </div>
        </div>
        <hr class="h-0.5 md:h-[0.15rem] my-8 md:my-16 -mx-0.5 md:-mx-2 bg-neutral-800">

        <div class="md:flex">
            <h3 class="text-xl md:text-4xl mt-6 md:mt-0 font-medium md:w-2/5 flex-shrink-0">
                Podieľali/jú sa na projekte
            </h3>
            <dl class="divide-neutral-400 divide-y mt-8 md:mt-0">
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Odborná garantka</dt>
                    <dd class="col-span-3">Zoja Droppová, droppova@gmb.sk</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Koordinátorka projektu</dt>
                    <dd class="col-span-3">Linda Blahová, blahova@gmb.sk</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Autorky koncepcie</dt>
                    <dd class="col-span-3">Zoja Droppová, Katarína Trnovská</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Texty k dielam</dt>
                    <dd class="col-span-3">Zoja Droppová (ZD), Sabina Jankovičová (SJ)</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Fotografie</dt>
                    <dd class="col-span-3">Matej Hakár, Jana Hamšíková, Andrej Kapcár, archív fotografií
                        autorov,inštitúcií, združení</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Grafický dizajn</dt>
                    <dd class="col-span-3">Gorazd Ratulovský</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Vývoj databázy</dt>
                    <dd class="col-span-3">lab.SNG (Michal Čudrnák, Ernest Walzel, František Sebestyén)</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Používateľský prieskum, testovanie wireframe</dt>
                    <dd class="col-span-3">Katarína Buzová</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Jazyková korektúra</dt>
                    <dd class="col-span-3">Daniela Marsinová</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Spolupráca na databáze</dt>
                    <dd class="col-span-3">Nikoleta Bukovská, Barbara Davidson, Anna Jablonowska Holly</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Poďakovanie</dt>
                    <dd class="col-span-3">Mestský ústav ochrany pamiatok, Slovenská národná galéria, Oddelenie kultúry
                        magistrátu hl.
                        mesta SR Bratislava</dd>
                </div>
            </dl>
        </div>
    </div>
@endsection
