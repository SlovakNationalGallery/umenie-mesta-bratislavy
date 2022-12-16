@extends('layouts.app')

@section('content')
    <div class="bg-neutral-100">
        <div class="max-w-screen-3xl px-4 md:px-14 mx-auto md:grid grid-cols-2">
            <div class="my-6 mx-10 md:ml-0 md:mr-40">
                <home-map :locations="{{ $locations }}" class="mx-auto"></home-map>
            </div>
            <div class="mt-auto pt-4 md:mb-14">
                <div class="prose md:prose-xl leading-snug mb-4 md:mb-8">
                    <h2 class="font-medium md:font-semibold">
                        Objavujte umenie v uliciach Bratislavy. <br />
                        <span class="hidden md:block font-normal">
                            Cieľom je prezentovať a popularizovať pestrú škálu umenia vo verejnom priestore od
                            2. polovice 20. storočia až po súčasnosť.
                        </span>
                    </h2>
                </div>
                <div class="prose text-neutral-500">
                    <span class="uppercase text-neutral-500 font-medium">Aktuálne spracované data</span>
                    <div
                        class="flex flex-col md:flex-row overflow-x-auto justify-between md:items-center gap-x-2 gap-y-2 pb-2 mb-6 md:mb-10 leading-none">
                        <div class="flex gap-x-2 items-center min-w-max">
                            <span class="text-4xl font-medium pr-1">{{ $stats['artworks'] }}</span>
                            <span class="leading-none mt-[0.15rem] text-base">diel<br /> v katalógu</span>
                        </div>
                        <div class="flex gap-x-2 items-center min-w-max">
                            <span class="text-4xl font-medium pr-1">{{ $stats['boroughs'] }}/17</span>
                            <span class="leading-none mt-[0.15rem] text-base">mestských<br />častí</span>
                        </div>
                        <div class="flex gap-x-2 items-center min-w-max">
                            <span
                                class="text-4xl font-medium pr-1">{{ optional($stats['lastUpdate'])->isoFormat('DD/MM/YY') }}</span>
                            <span class="leading-none mt-[0.15rem] text-base">naposledy<br />aktualizované</span>
                        </div>
                    </div>
                </div>
                <a class="font-medium inline-block mb-10 px-4 py-2 md:px-6 md:py-4 border-2 prose md:prose-2xl border-neutral-800 uppercase"
                    href="{{ route('artworks.index') }}">
                    Preskúmať diela
                </a>
            </div>
        </div>

        <div class="bg-white">
            <div class="max-w-screen-3xl px-4 md:px-14 mx-auto pt-16">
                <h2 class="text-3xl font-medium">
                    Najnovšie diela <br class="sm:hidden" />
                    v katalógu
                </h2>

                <div class="pt-2 pb-14">
                    <artworks-masonry item-selector=".grid-item" class="-mt-2 -mx-4">
                        @foreach ($artworks as $a)
                            <x-artwork-card :artwork="$a" class="grid-item sm:w-1/4 p-4" />
                        @endforeach
                    </artworks-masonry>
                </div>
            </div>
        </div>
    </div>
@endsection

