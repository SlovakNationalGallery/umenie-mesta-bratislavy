@extends('layouts.app')

@section('content')
    <div class="bg-neutral-100">
        <div class="max-w-screen-3xl px-4 lg:px-14 mx-auto lg:grid grid-cols-2">
            <div class="my-6 mx-10 lg:ml-0 lg:mr-40">
                <home-map :locations="{{ $locations }}" class="mx-auto"></home-map>
            </div>
            <div class="mt-auto pt-4 lg:mb-14">
                <div class="prose lg:prose-xl leading-snug mb-4 lg:mb-8">
                    <h2 class="font-medium lg:font-semibold">
                        Objavujte a chráňte umenie v uliciach Bratislavy.<br />
                        <span class="hidden lg:block font-normal">
                            Databáza dokumentuje a popularizuje pestrú škálu diel vo verejnom priestore od 2.&nbsp;polovice
                            20.&nbsp;storočia až po súčasnosť.
                        </span>
                    </h2>
                </div>
                <div class="prose text-neutral-500">
                    <span class="uppercase text-neutral-500 font-medium">Aktuálne spracované data</span>
                    <div
                        class="flex flex-col lg:flex-row overflow-x-auto justify-between lg:items-center gap-x-2 gap-y-2 pb-2 mb-6 lg:mb-10 leading-none">
                        <div class="flex gap-x-2 items-center min-w-max">
                            <span class="text-4xl font-medium pr-1">{{ $stats['artworks'] }}</span>
                            <span class="leading-none mt-[0.15rem] text-base">diel<br /> v katalógu</span>
                        </div>
                        <div class="flex gap-x-2 items-center min-w-max">
                            <span class="text-4xl font-medium pr-1">{{ $stats['boroughs'] }} zo 17</span>
                            <span class="leading-none mt-[0.15rem] text-base">mestských<br />častí</span>
                        </div>
                        <div class="flex gap-x-2 items-center min-w-max">
                            <span
                                class="text-4xl font-medium pr-1">{{ optional($stats['lastUpdate'])->isoFormat('DD/MM/YY') }}</span>
                            <span class="leading-none mt-[0.15rem] text-base">naposledy<br />aktualizované</span>
                        </div>
                    </div>
                </div>
                <a class="font-medium inline-block mb-10 px-4 py-2 lg:px-6 lg:py-4 border-2 prose lg:prose-2xl border-neutral-800 uppercase hover:text-white hover:bg-red-500 hover:border-transparent transition-all duration-150"
                    href="{{ route('artworks.index') }}">
                    Preskúmať diela
                </a>
            </div>
        </div>

        <div class="bg-white">
            <div class="max-w-screen-3xl px-4 lg:px-14 mx-auto pt-16">
                <div class="justify-between items-center flex w-full">
                    <h2 class="text-3xl font-medium">
                        Najnovšie diela <br class="sm:hidden" />
                        v katalógu
                    </h2>
                    <div
                        class="flex items-center justify-center px-6 py-3 border-2 my-1 border-neutral-800 text-neutral-800 hover:text-white hover:bg-red-500 hover:border-transparent transition-all duration-150">
                        <a href="{{ route('artworks.index') }}" class="uppercase pr-4 font-medium">
                            viac diel
                        </a>
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M0.5 9.5H23" stroke-width="1.4" />
                            <path d="M14 18.5L23 9.5L14 0.5" stroke-width="1.4" />
                        </svg>
                    </div>
                </div>

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
