@extends('layouts.app')

@section('content')
    <div class="bg-neutral-100">
        <div class="max-w-screen-3xl px-4 lg:px-14 mx-auto lg:grid grid-cols-2">
            <div class="my-6 mx-10 lg:ml-0 lg:mr-40">
                <home-map :locations="{{ $locations }}" class="mx-auto"></home-map>
            </div>
            <div class="mt-auto pt-4 lg:mb-14">
                <div class="text-2xl lg:text-4xl mb-4 lg:mb-8">
                    <h2 class="font-medium lg:font-semibold text-neutral-800">
                        Všímajte si umenie v uliciach Bratislavy.
                    </h2>

                    <span class="hidden lg:block">
                        Databáza dokumentuje a popularizuje pestrú škálu diel vo verejnom priestore od 2.&nbsp;polovice
                        20.&nbsp;storočia až po súčasnosť.
                    </span>

                </div>
                <div class="prose text-neutral-500">
                    <span class="uppercase text-neutral-500 font-medium text-sm">Aktuálne spracované data</span>
                    <div
                        class="mt-2 flex flex-col xl:flex-row xl:items-center gap-x-8 gap-y-2 pb-2 mb-6 xl:mb-10 leading-none text-lg">
                        <div class="flex gap-x-2 items-center">
                            <span class="text-[2.5rem] mt-0.5">{{ $stats['artworks'] }}</span>
                            <span class="leading-none">diel<br /> v&nbsp;katalógu</span>
                        </div>
                        <div class="flex gap-x-2 items-center">
                            <span class="text-[2.5rem] mt-0.5">{{ $stats['boroughs'] }}/17</span>
                            <span class="leading-none">mestských<br />častí</span>
                        </div>
                        <div class="flex gap-x-2 items-center">
                            <span
                                class="text-[2.5rem] mt-0.5">{{ optional($stats['lastUpdate'])->isoFormat('DD/MM/YY') }}</span>
                            <span class="leading-none">naposledy<br />aktualizované</span>
                        </div>
                    </div>
                </div>
                <a class="font-medium text-neutral-800 inline-block mb-10 px-4 py-2 lg:px-8 lg:py-2.5 border-2 prose lg:prose-xl border-neutral-800 uppercase hover:text-white hover:bg-red-500 hover:border-transparent transition-all duration-150"
                    href="{{ route('artworks.index') }}">
                    Preskúmať diela
                </a>
            </div>
        </div>

        <div class="bg-white">
            <div class="max-w-screen-3xl px-4 mx-auto pt-10 lg:px-14 lg:pt-16">
                <div
                    class="flex flex-col items-start leading-none pb-4 lg:justify-between lg:items-center lg:w-full lg:flex-row lg:pb-12">
                    <h2 class="text-3xl font-medium">
                        Najnovšie diela v&nbsp;katalógu
                    </h2>
                    <a href="{{ route('artworks.index') }}"
                        class="flex items-center justify-center px-4 py-2 mt-4 lg:mt-0 lg:px-6 border-2 border-neutral-800 text-neutral-800 hover:text-white hover:bg-red-500 hover:border-transparent transition-all duration-150">
                        <span class="uppercase pr-2 font-medium text-sm lg:text-base">viac diel</span>
                        <svg width="24" height="19" viewBox="0 0 24 19" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M0.5 9.5H23" stroke-width="1.4" />
                            <path d="M14 18.5L23 9.5L14 0.5" stroke-width="1.4" />
                        </svg>
                    </a>
                </div>

                <div class="pt-2 pb-14">
                    <artworks-masonry item-selector=".grid-item" class="-mt-2 -mx-4">
                        @foreach ($artworks as $a)
                            <x-artwork-card :artwork="$a" class="grid-item w-1/2 sm:w-1/4 p-2 lg:p-4" />
                        @endforeach
                    </artworks-masonry>
                </div>
            </div>
        </div>
    </div>
@endsection
