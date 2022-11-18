@extends('layouts.app')

@section('content')
    <section class="px-4">

        <h2 class="mt-10 text-3xl font-medium">
            Najnovšie diela <br class="sm:hidden" />
            v katalógu
        </h2>

        <div class="pt-2 pb-14">
            @php
                $artworks = \App\Models\Artwork::with(['authors', 'coverPhotoMedia'])
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
                <span class="block text-sm">1988&mdash;2015</span>
            @endforeach
        </div>
    </section>
@endsection

