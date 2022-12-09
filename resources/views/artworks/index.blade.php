@extends('layouts.app')

@section('content')
    <section class="max-w-screen-3xl px-4 md:px-14 mx-auto flex">
        <div class="w-1/3 relative flex-shrink-0">
            <img src="https://placeholder.pics/svg/300/DEDEDE/555555/mapa" class="w-full top-5 sticky">
        </div>

        <div class="w-2/3">
            <div class="-mt-4 -mr-4" data-masonry='{ "itemSelector": ".grid-item" }'>
                @foreach ($artworks as $a)
                    <x-artwork-card :artwork="$a" class="grid-item sm:w-1/3 p-4" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
