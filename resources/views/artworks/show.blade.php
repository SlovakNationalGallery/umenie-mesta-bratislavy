@extends('layouts.app')

@section('content')
    @php
        $photoMedias = $artwork->photos->filter(fn($p) => $p->hasMedia())->map(
            fn($photo) => $photo
                ->getFirstMedia()
                ->img()
                ->toHtml(),
        );
    @endphp
    <div class="pt-10 max-w-5xl mx-auto bg-neutral-100">
        <artwork-carousel :artwork-photos="{{ $artwork->photos }}" :photo-medias="{{ $photoMedias }}">
        </artwork-carousel>
    </div>
    <div class="p-4 max-w-5xl mx-auto">
        <a href="{{ route('artworks.index') }}" class="mt-4 -ml-1 text-xs underline inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            <span class="x-ml-1">Späť na zoznam diel</span>
        </a>

        <h1 class="text-2xl md:text-4xl font-medium mt-3 md:mt-7">{{ $artwork->name }}</h1>
        <div class="mt-1">
            @foreach ($artwork->authors as $author)
                <a href="#TODO" class="underline">{{ $author->name }}</a>{{ $loop->last ? '' : ', ' }}
            @endforeach
            @if ($artwork->yearBuilt)
                / {{ $artwork->yearBuilt->toFormattedString() }}
            @endif
        </div>

        <div class="md:grid grid-cols-3 gap-x-8 mt-6 md:mt-8">
            <div class="col-span-2 flex flex-col">
                <article class="prose text-neutral-800">
                    {!! Str::markdown($artwork->description ?? '') !!}
                </article>

                <div class="md:order-last">
                    <hr class="neutral-100 hidden md:block md:mt-8" />

                    <div class="mt-4 flex gap-4 md:mt-8">
                        @foreach ($artwork->keywords as $keyword)
                            <a href="TODO" class="px-2 py-1 border border-neutral-800">{{ $keyword->keyword }}</a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <hr class="neutral-100 mt-6 md:mt-8" />

                    {{-- TODO: dynamically plural/singular --}}
                    <h4 class="font-medium mt-6 md:mt-8">Autori</h4>
                    <ul>
                        @foreach ($artwork->authors as $author)
                            <li><a href="TODO" class="underline">{{ $author->name }}</a></li>
                        @endforeach
                    </ul>

                    <h4 class="font-medium mt-4 md:mt-6">Spoluautori</h4>
                    <ul>
                        @foreach ($artwork->coauthors as $coauthor)
                            <li><a href="TODO" class="underline">{{ $coauthor->name }}</a></li>
                        @endforeach
                    </ul>

                    <hr class="neutral-100 mt-6" />

                    <h4 class="font-medium mt-8">Roky</h4>
                    <ul>
                        @foreach ($artwork->years as $year)
                            <li>{{ $year->toFormattedString() }} &mdash; {{ $year->type }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="md:border-l md:pl-8">
                <hr class="neutral-100 mt-6 md:hidden" />

                <h4 class="font-medium mt-6 md:mt-0">Druh</h4>
                <ul>
                    @foreach ($artwork->categories as $category)
                        <li><a href="TODO" class="underline">{{ $category->name }}</a></li>
                    @endforeach
                </ul>

                <h4 class="font-medium mt-6">Materiál</h4>
                {{ collect($artwork->materials)->pluck('name')->join(', ') }}

                <h4 class="font-medium mt-6">Technika</h4>
                {{ collect($artwork->techniques)->pluck('name')->join(', ') }}

                <h4 class="font-medium mt-6">Rozmer</h4>
                {{ $artwork->dimensions }}

                <h4 class="font-medium mt-6">Signatúra</h4>
                {{ optional($artwork->signature)->position }} {{ optional($artwork->signature)->description }}

                <h4 class="font-medium mt-6">Stav</h4>
                <ul>
                    @foreach ($artwork->conditions as $condition)
                        <li>{{ $condition->name }}</li>
                    @endforeach
                </ul>
                @if ($artwork->condition_note)
                    <div class="text-neutral-500 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 mt-[0.15rem] mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                        </svg>

                        <span>{{ $artwork->condition_note }}</span>
                    </div>
                @endif
                <h4 class="font-medium mt-6">Evidovaná / Existujúci stupeň ochrany</h4>
                <ul>
                    @foreach ($artwork->registrations as $registration)
                        <li>{{ $registration->name }}</li>
                    @endforeach
                </ul>

                <h4 class="font-medium mt-6">Vlastník</h4>
                <ul>
                    @foreach ($artwork->owners as $owner)
                        <li>{{ $owner->name }}</li>
                    @endforeach
                </ul>
                <h4 class="font-medium mt-6">Správca</h4>
                <ul>
                    @foreach ($artwork->maintainers as $maintainer)
                        <li>{{ $maintainer->name }}</li>
                    @endforeach
                </ul>

                @if ($artwork->currentLocation)
                    <hr class="neutral-100 mt-6" />

                    <h4 class="font-medium mt-6">Adresa</h4>
                    {{ $artwork->currentLocation->address }}

                    <h4 class="font-medium mt-6">Bližšie informácie o lokalite</h4>
                    {{ $artwork->currentLocation->description }}

                    <h4 class="font-medium mt-6">GPS</h4>
                    {{ $artwork->currentLocation->gps_lat }}, {{ $artwork->currentLocation->gps_lon }}

                    <h4 class="font-medium mt-6">Číslo parcely</h4>
                    {{ $artwork->currentLocation->plot }}
                @endif
            </div>
        </div>
    </div>
    @if ($artwork->currentLocation && $artwork->currentLocation->gps_lon && $artwork->currentLocation->gps_lat)
        <div class="h-[330px] lg:h-[500px]">
            <map-container class="h-full" :cluster="false"
                :center="[{{ $artwork->currentLocation->gps_lon }}, {{ $artwork->currentLocation->gps_lat }}]"
                :zoom="16" highlight-id="{{ $artwork->id }}" />
        </div>
    @endif
    {{-- TODO -- GMBUVP-18 --}}
    {{-- <div class="pt-10 pb-6 px-4 max-w-screen-3xl md:px-14 mx-auto">
        <h3 class="text-3xl font-medium mt-3">Ďalšie diela v okolí</h3>

        <div class="mt-4 -mx-4" data-masonry='{ "itemSelector": ".grid-item" }'>
            @foreach ($relatedArtworks as $a)
                <x-artwork-card :artwork="$a" class="grid-item sm:w-1/4 p-4" />
            @endforeach
        </div>
    </div> --}}

    <div class="hidden">
        <article id="popup">
            <h1 class="font-medium mb-3 text-lg">{{ $artwork->name }}</h1>
            <div class="leading-none space-y-2 text-sm">
                <p class="font-medium mb-2">{{ $artwork->currentLocation->address }}</p>
                <p class="mb-2">{{ $artwork->currentLocation->description }}</p>
                <p class="mb-2">
                    <a class="underline hover:no-underline"
                        href="https://www.google.com/maps/place/{{ $artwork->currentLocation->gps_lat }},{{ $artwork->currentLocation->gps_lon }}">Otvoriť
                        v Google Maps</a>
                </p>
            </div>
        </article>
    </div>
@endsection

