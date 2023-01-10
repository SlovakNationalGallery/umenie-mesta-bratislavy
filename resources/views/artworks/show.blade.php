@extends('layouts.app')

@section('title')
    {{ $artwork->name }} — Umenie mesta Bratislavy
@endsection
@section('og.type', 'article')
@section('og.title', $artwork->name)
@section('og.description', Str::limit(strip_tags($artwork->descriptionHtml), 255))
@section('og.image', $artwork->coverPhotoMedia->getUrl())

@section('content')
    <div class="pt-10 max-w-5xl mx-auto bg-neutral-100">
        <artwork-carousel :photos="{{ Js::from($artwork->photoMediaForCarousel) }}">
        </artwork-carousel>
    </div>
    <div class="bg-white">
        <div class="p-4 max-w-5xl mx-auto">
            <a href="{{ route('artworks.index') }}" class="mt-4 -ml-1 text-xs underline inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                <span class="x-ml-1">Späť na zoznam diel</span>
            </a>

            <h1 class="text-2xl lg:text-4xl font-medium mt-3 lg:mt-7">{{ $artwork->name }}</h1>
            <div class="mt-1">
                @foreach ($artwork->authors as $author)
                    <a href="{{ route('artworks.index', ['authors[]' => $author->id]) }}"
                        class="underline">{{ $author->name }}</a>{{ $loop->last ? '' : ', ' }}
                @endforeach
                @if ($artwork->yearBuilt)
                    / {{ $artwork->yearBuilt->toFormattedString() }}
                @endif
            </div>

            <div class="lg:grid grid-cols-3 gap-x-8 mt-6 lg:mt-8">
                <div class="col-span-2 flex flex-col">
                    <article class="prose text-neutral-800">
                        {!! $artwork->descriptionHtml !!}
                    </article>

                    <div class="lg:order-last">
                        <hr class="neutral-100 hidden lg:block lg:mt-8" />

                        <div class="mt-4 flex gap-4 lg:mt-8">
                            @foreach ($artwork->keywords as $keyword)
                                <a href="{{ route('artworks.index', ['keywords[]' => $keyword->id]) }}"
                                    class="px-2 py-1 border border-neutral-800">
                                    {{ $keyword->keyword }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <hr class="neutral-100 mt-6 lg:mt-8" />

                        <h4 class="font-medium mt-6 lg:mt-8">Autori</h4>
                        <ul>
                            @foreach ($artwork->authors as $author)
                                <li>
                                    <a href="{{ route('artworks.index', ['authors[]' => $author->id]) }}"
                                        class="underline">
                                        {{ $author->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <h4 class="font-medium mt-4 lg:mt-6">Spoluautori</h4>
                        <ul>
                            @foreach ($artwork->coauthors as $coauthor)
                                <li>
                                    <a href="{{ route('artworks.index', ['authors[]' => $coauthor->id]) }}"
                                        class="underline">
                                        {{ $coauthor->name }}
                                    </a>
                                </li>
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

                <div class="lg:border-l lg:pl-8">
                    <hr class="neutral-100 mt-6 lg:hidden" />

                    <h4 class="font-medium mt-6 lg:mt-0">Druh</h4>
                    <ul>
                        @foreach ($artwork->categories as $category)
                            <li>
                                <a href="{{ route('artworks.index', ['categories[]' => $category->id]) }}"
                                    class="underline">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <h4 class="font-medium mt-6">Materiál</h4>
                    {{ collect($artwork->materials)->pluck('name')->join(', ') }}

                    <h4 class="font-medium mt-6">Technika</h4>
                    {{ collect($artwork->techniques)->pluck('name')->join(', ') }}

                    <h4 class="font-medium mt-6">Rozmer</h4>
                    {{ $artwork->dimensions }}

                    <h4 class="font-medium mt-6">Značenie</h4>
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
                        @if ($artwork->currentLocation->gps_lat && $artwork->currentLocation->gps_lon)
                            {{ $artwork->currentLocation->gps_lat }}, {{ $artwork->currentLocation->gps_lon }}
                        @endif

                        <h4 class="font-medium mt-6">Číslo parcely</h4>
                        {{ $artwork->currentLocation->plot }}
                    @endif
                </div>
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
    <div class="pt-10 pb-6 px-4 max-w-screen-3xl lg:px-14 mx-auto">
        <h3 class="text-3xl font-medium mt-3">Ďalšie diela v okolí</h3>

        <div class="mt-4 -mx-4" data-masonry='{ "itemSelector": ".grid-item" }'>
            @foreach ($relatedArtworks as $a)
                <x-artwork-card :artwork="$a" class="grid-item sm:w-1/4 p-4" />
            @endforeach
        </div>
    </div>

    <div class="hidden">
        <article id="popup">
            <h1 class="font-medium mb-3 text-lg">{{ $artwork->name }}</h1>
            <div class="leading-none space-y-2 text-sm">
                <p class="font-medium">{{ $artwork->currentLocation->address }}</p>
                <p>{{ $artwork->currentLocation->description }}</p>
                <p>
                    <a class="underline hover:no-underline"
                        href="https://www.google.com/maps/place/{{ $artwork->currentLocation->gps_lat }},{{ $artwork->currentLocation->gps_lon }}">Otvoriť
                        v Google Maps</a>
                </p>
            </div>
        </article>
    </div>
@endsection

