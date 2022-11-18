@extends('layouts.app')

@section('content')
    <div class="p-4 bg-neutral-100">
        <div class="relative">
            <img src="https://placeholder.pics/svg/300/DEDEDE/555555/mapa" class="w-full">
            <div class="absolute inset-0 flex justify-center items-center">
                <a href="TODO" class="text-lg bg-neutral-800 text-white inline-flex items-center rounded-full px-4 py-2">
                    Objavte diela v okolí
                    {{-- TODO get right icon --}}
                    <x-icons.map-pin class="ml-1" />
                </a>
            </div>
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
                    ->take(2)
                    ->get();
            @endphp
            @foreach ($artworks as $a)
                <a class="mt-8 block" href="TODO">
                    {{ $a->coverPhotoMedia->img()->attributes(['class' => 'w-full rounded-2xl max-h-60 object-cover object-center']) }}
                </a>
                <h4 class="text-2xl font-medium mt-2">{{ $a->name }}</h4>
                <span class="block text-sm">{{ $a->authors->map->name->join(', ') }}</span>
                <span class="block text-sm">{{ optional($a->yearBuilt)->toFormattedString() }}</span>
            @endforeach
        </div>
    </section>
@endsection

