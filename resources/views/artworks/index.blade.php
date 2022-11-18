@extends('layouts.app')

@section('content')
    <section class="-4">

        <h2 class="mt-10 text-3xl font-medium">
            Najnovšie diela <br class="sm:hidden" />
            v katalógu
        </h2>

        <div class="pt-2 pb-14">
            @foreach ($artworks as $a)
                <x-artwork-card :artwork="$a" />
            @endforeach
        </div>
    </section>
@endsection
