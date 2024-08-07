@extends('layouts.app')

@section('title')
    O projekte — Umenie mesta Bratislavy
@endsection

@section('content')
    <div class="max-w-screen-3xl p-4 lg:p-14 mx-auto lg:text-2xl lg:flex">
        <h3 class="text-xl lg:text-4xl font-medium lg:w-2/5 flex-shrink-0">
            O projekte
        </h3>
        <div>
            <div class="prose mt-8 lg:mt-2 lg:text-2xl text-neutral-800">
                <p>
                    Databázu diel vo verejnom priestore ako svoj vedeckovýskumný projekt založila a spravuje <a
                        href="https://gmb.sk/" class="hover:text-red-500" target="_blank">Galéria mesta
                        Bratislavy</a>. Kurátorský
                    výber diel vzniká od roku 2022, pričom jednotlivé informácie sa budú pravidelne dopĺňať a aktualizovať.
                    Postupne tak pribudnú diela všetkých <a
                        href="https://bratislava.sk/mesto-bratislava/sprava-mesta/mestske-casti" class="hover:text-red-500"
                        target="_blank">piatich mestských
                        okresov a sedemnástich samosprávnych mestských častí</a>.
                </p>

                <p>Okrem diel existujúcich na pôvodných miestach sa mapujú aj fragmenty a diela presunuté, odstránené alebo
                    zničené v kategóriách:</p>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="max-w-screen-3xl p-4 lg:p-14 mx-auto lg:flex">
            <h3 class="text-xl lg:text-4xl mt-6 lg:mt-0 font-medium lg:w-2/5 flex-shrink-0">
                Kategórie diel v katalógu
            </h3>
            <div class="text-xl lg:text-2xl mt-8 lg:mt-0">
                <div class="gap-x-6 grid gap-y-6 lg:grid-rows-5 lg:grid-flow-col flex-grow">
                    @foreach ($categories as $category)
                        <x-category-with-icon :icon="$category->icon"
                            :id="$category->id">{{ $category->name }}</x-category-with-icon>
                    @endforeach
                </div>
                <div class="flex items-center gap-x-4 lg:gap-x-6 mt-16">
                    <x-icons.pins.defunct class="w-10 h-10 lg:w-12 lg:h-auto flex-shrink-0" />
                    Označenie zaniknutého diela
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-screen-3xl p-4 lg:p-14 mx-auto lg:text-2xl">
        <div class="lg:flex">
            <div class="lg:w-2/5 flex-shrink-0">
                <h4 class="text-lg lg:text-3xl mt-6 lg:mt-0 font-medium">
                    Aktuálne spracované dáta
                </h4>
                <div class="mt-8 lg:mt-10 flex flex-col gap-y-6">
                    <div class="flex items-end leading-none gap-x-2">
                        <span class="text-4xl font-medium">{{ $stats['artworks'] }}</span>
                        <span class="text-base">diel v katalógu</span>
                    </div>
                    <div class="flex items-end leading-none gap-x-2">
                        <span class="text-4xl font-medium">{{ $stats['boroughs'] }}/17</span>
                        <span class="text-base">mestských častí</span>
                    </div>
                    <div class="flex items-end leading-none gap-x-2">
                        <span class="text-4xl font-medium">
                            {{ optional($stats['lastUpdate'])->isoFormat('DD/MM/YY') }}
                        </span>
                        <span class="text-base">naposledy aktualizované</span>
                    </div>
                </div>
            </div>
            <div class="mt-8 lg:mt-0">
                <div class="prose mt-2 lg:text-2xl text-neutral-800">
                    <p>
                        Ambíciou projektu je vytvoriť dynamickú a otvorenú databázu, ktorá sa bude pravidelne dopĺňať o nové
                        poznatky z výskumu, aktualizovať aj revidovať. Základným kritériom kurátorského výberu do databázy
                        Umenia mesta Bratislavy GMB je tvorba profesionálnych autorov*iek (výtvarných umelcov*kýň,
                        architektov*tiek, dizajnérov*iek a súvisiacich odborov) z obdobia po roku 1945 zastúpených v
                        zbierkach GMB či v iných zbierkotvorných a výskumných inštitúciách. Pozornosť sa zameriava na
                        najviac ohrozené diela, ktoré potrebujú ochranu a odborné postupy pri údržbe i obnove.
                    </p>

                    <p>Cieľom je prezentovať a popularizovať pestrú škálu umenia vo verejnom priestore od druhej polovice
                        20.&nbsp;storočia až po súčasnosť a priniesť čo najviac informácií o význame, okolnostiach vzniku a
                        príbehoch diel, o ich autoroch, použitých materiáloch či výtvarných technikách. Zámerom je tiež
                        získať aktuálne údaje o stave a presnom umiestnení diel, ich GPS súradniciach, vlastníkoch a
                        správcoch. Pri väčšine diel vo verejnom priestore sú práve nejasné vlastnícke vzťahy príčinou
                        chýbajúcej starostlivosti a nevhodného zaobchádzania.</p>

                    <p>
                        Údaje v databáze sú tvorené tak, aby sa postupne dali prepájať s <a href="https://www.webumenia.sk/"
                            class="hover:text-red-500" target="_blank">Web umenia</a> a s ďalšími registrami či katalógmi
                        zameranými napríklad na galerijné a múzejné zbierky, modernú architektúru i národné kultúrne
                        pamiatky a s databázami diel vo verejnom priestore v iných mestách.
                    </p>
                    <p>
                        Galéria mesta Bratislavy podniká potrebné kroky na zisťovanie autorov diel a archívnej
                        fotodokumentácie. Autorskoprávne nároky k dielam boli riadne vysporiadané. Údaje sa budú na
                        webstránke pravidelne aktualizovať.
                    </p>
                    <p>
                        Projekt sa realizuje vďaka finančnej podpore hlavného mesta SR Bratislava a Fondu na podporu umenia.
                    </p>
                </div>
            </div>
        </div>
        <hr class="h-0.5 lg:h-[0.15rem] my-8 lg:my-16 -mx-0.5 lg:-mx-2 bg-neutral-800">

        <div class="lg:flex">
            <h3 class="text-xl lg:text-4xl mt-6 lg:mt-0 font-medium lg:w-2/5 flex-shrink-0">
                Tím
            </h3>
            <dl class="divide-neutral-400 divide-y mt-8 lg:mt-0">
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Odborná garantka</dt>
                    <dd class="col-span-3">Zoja Droppová</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Koordinátorka projektu</dt>
                    <dd class="col-span-3">Linda Blahová, linda.blahova@gmb.sk</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Autorky koncepcie</dt>
                    <dd class="col-span-3">Zoja Droppová, Katarína Trnovská, Linda Blahová</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Texty o dielach</dt>
                    <dd class="col-span-3">Zoja Droppová (ZD), Sabina Jankovičová (SJ), Nikoleta Bukovská (NB), Zuzana
                        Zvarová (ZZ), Patrik Baxa (PB), Vladimíra Büngerová (VB), Peter Kršák (PK)</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Fotografie</dt>
                    <dd class="col-span-3">Matej Hakár, Jana Hamšíková, Andrej Kapcár, Zoja Droppová, Monika Kováčová (BSK),
                        Martin Kleibl, Pavel Vnuk, Peter Kršák, Sabina Jankovičová; archívy GMB, AMB, SNA; mestských častí;
                        <a href="https://www.webumenia.sk/" class="underline hover:text-red-500"
                            target="_blank">webumenia.sk</a>;
                        archívy bývalých umeleckých zväzov a fondov, projektových ústavov, autorov*iek diel a dedičov*iek.
                    </dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Grafický dizajn</dt>
                    <dd class="col-span-3">Gorazd Ratulovský</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Vývoj databázy</dt>
                    <dd class="col-span-3">
                        lab.SNG (Michal Čudrnák, Ernest Walzel, František Michal Sebestyén, Rastislav Chynoranský, Igor
                        Rjabinin)
                    </dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Používateľský prieskum, koordinácia vývoja</dt>
                    <dd class="col-span-3">Katarína Vass</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Jazyková korektúra</dt>
                    <dd class="col-span-3">Daniela Marsinová, Miroslava Kuracinová Valová</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Spolupráca na databáze</dt>
                    <dd class="col-span-3">Nikoleta Bukovská, Anna Jablonowska Holly</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Odborné konzultácie</dt>
                    <dd class="col-span-3">Barbara Davidson</dd>
                </div>
                <div class="grid grid-cols-5 py-4">
                    <dt class="font-medium col-span-2">Poďakovanie</dt>
                    <dd class="col-span-3">Mestský ústav ochrany pamiatok, Slovenská národná galéria, Oddelenie kultúry
                        magistrátu hl. mesta SR Bratislava, Slovenský národný archív, Archív mesta Bratislavy, Archív
                        Slovenskej technickej univerzity, autori*ky diel, pamätníci*čky a dediči*ky.</dd>
                </div>
            </dl>
        </div>
    </div>
@endsection
