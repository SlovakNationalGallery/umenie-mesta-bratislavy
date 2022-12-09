@extends('layouts.app')

@section('content')
    <div class="bg-neutral-100">
        <div class="max-w-screen-3xl px-4 md:px-14 mx-auto md:flex">
            <div class="relative">
                <home-map :locations="{{ $locations }}"></home-map>
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

