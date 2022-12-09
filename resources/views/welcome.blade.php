@extends('layouts.app')

@section('content')
    <div class="bg-neutral-100">
        <div class="max-w-screen-3xl px-4 md:px-14 mx-auto md:grid grid-cols-2">
            <div class="relative">
                <home-map :locations="{{ $locations }}" class="mx-auto"></home-map>
            </div>

            {{-- TODO format properly --}}
            <div class="flex flex-col gap-y-2">
                <div class="flex items-start gap-x-2">
                    <span class="text-4xl font-medium">{{ $stats['artworks'] }}</span>
                    <span class="leading-none mt-[0.15rem] text-base">diel<br /> v katalógu</span>
                </div>
                <div class="flex items-start gap-x-2">
                    <span class="text-4xl font-medium">{{ $stats['boroughs'] }}/17</span>
                    <span class="leading-none mt-[0.15rem] text-base">mestských<br />častí</span>
                </div>
                <div class="flex items-start gap-x-2">
                    <span class="text-4xl font-medium">{{ $stats['lastUpdate']->isoFormat('DD/MM/YY') }}</span>
                    <span class="leading-none mt-[0.15rem] text-base">naposledy<br />aktualizované</span>
                </div>
            </div>
        </div>

        <div class="bg-white">
            <div class="max-w-screen-3xl px-4 md:px-14 mx-auto pt-16">
                <h2 class="text-3xl font-medium">
                    Najnovšie diela <br class="sm:hidden" />
                    v katalógu
                </h2>

                <div class="pt-2 pb-14">
                    <div class="-mt-2 -mx-4" data-masonry='{ "itemSelector": ".grid-item" }'>
                        @foreach ($artworks as $a)
                            <x-artwork-card :artwork="$a" class="grid-item sm:w-1/4 p-4" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

