@extends('layouts.app')

@section('content')
    <div class="p-4 bg-neutral-100">
        <div class="relative">
            <map-component :locations="{{ $locations }}"></map-component>
        </div>
    </div>

    <section class="px-4">

        <h2 class="mt-10 text-3xl font-medium">
            Najnovšie diela <br class="sm:hidden" />
            v katalógu
        </h2>

        <div class="pt-2 pb-14">
            @php
                $artworks = \App\Models\Artwork::with(['authors', 'coverPhotoMedia', 'yearBuilt'])
                    ->has('coverPhotoMedia')
                    ->take(4)
                    ->get();
            @endphp
            <div class="-mt-2 -mx-4" data-masonry='{ "itemSelector": ".grid-item" }'>
                @foreach ($artworks as $a)
                    <x-artwork-card :artwork="$a" class="grid-item sm:w-1/4 p-4" />
                @endforeach
            </div>
        </div>
    </section>
@endsection

