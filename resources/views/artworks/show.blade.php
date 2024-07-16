@extends('layouts.app')

@section('title')
    {{ $artwork->name }} — Umenie mesta Bratislavy
@endsection
@section('og.type', 'article')
@section('og.title', $artwork->name)
@section('og.description', Str::limit(strip_tags($artwork->descriptionHtml), 255))
@section('og.image', $artwork->coverPhotoMedia->getUrl())

@section('content')
    <div class="mx-auto w-full max-w-screen-3xl px-4 lg:px-14">
        <a href="{{ route('artworks.index') }}"
            class="mb-3 flex h-10 w-10 items-center justify-center rounded-full bg-white stroke-neutral-800 stroke-2">
            <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.25 8.99902H1.75" />
                <path d="M9.15039 16.3996L1.75039 8.99961L9.15039 1.59961" />
            </svg>
        </a>
    </div>
    <div class="mx-auto max-w-5xl bg-neutral-100 p-4 pt-0 lg:pb-0">
        <artwork-carousel :photos="{{ Js::from($artwork->photoMediaForCarousel) }}">
        </artwork-carousel>
    </div>
    <div class="bg-white">
        <div class="mx-auto max-w-5xl p-4">
            <h1 class="mt-3 text-2xl font-medium lg:mt-7 lg:text-4xl">{{ $artwork->name }}</h1>
            <div class="mt-1">
                @foreach ($artwork->authors as $author)
                    <a href="{{ route('artworks.index', ['authors[]' => $author->id]) }}"
                        class="underline">{{ $author->name }}</a>{{ $loop->last ? '' : ', ' }}
                @endforeach
                @if ($artwork->yearBuilt)
                    / {{ $artwork->yearBuilt->toFormattedString() }}
                @endif
            </div>

            <div class="mt-6 grid-cols-3 gap-x-8 lg:mt-8 lg:grid">
                <div class="col-span-2 flex flex-col">
                    <article class="prose text-neutral-800">
                        {!! $artwork->descriptionHtml !!}
                    </article>

                    <div class="lg:order-last">
                        <hr class="neutral-100 hidden lg:mt-8 lg:block" />

                        <div class="mt-4 flex flex-wrap gap-4 lg:mt-8">
                            @foreach ($artwork->keywords as $keyword)
                                <a href="{{ route('artworks.index', ['keywords[]' => $keyword->id]) }}"
                                    class="border border-neutral-800 px-2 py-1">
                                    {{ $keyword->keyword }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <hr class="neutral-100 mt-6 lg:mt-8" />

                        <h4 class="mt-6 font-medium lg:mt-8">Autorstvo</h4>
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

                        @if (count($artwork->coauthors) > 0)
                            <h4 class="mt-4 font-medium lg:mt-6">Spoluautorstvo</h4>
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
                        @endif

                        <hr class="neutral-100 mt-6 lg:mt-8" />

                        <h4 class="mt-8 font-medium">Roky</h4>
                        <ul>
                            @foreach ($artwork->years as $year)
                                <li>{{ $year->toFormattedString() }} &ndash; {{ $year->type }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="lg:border-l lg:pl-8">
                    <hr class="neutral-100 mt-6 lg:hidden" />

                    <h4 class="mt-6 font-medium lg:mt-0">Druh</h4>
                    <ul>
                        @foreach ($artwork->categories as $category)
                            <li>
                                <a href="{{ route('artworks.index', ['categories[]' => $category->id]) }}"
                                    class="underline">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <h4 class="mt-6 font-medium">Materiál</h4>
                    {{ collect($artwork->materials)->pluck('name')->join(', ') }}

                    <h4 class="mt-6 font-medium">Technika</h4>
                    {{ collect($artwork->techniques)->pluck('name')->join(', ') }}

                    <h4 class="mt-6 font-medium">Rozmer</h4>
                    {{ $artwork->dimensions }}

                    <h4 class="mt-6 font-medium">Značenie</h4>
                    {{ optional($artwork->signature)->position }} {{ optional($artwork->signature)->description }}

                    <h4 class="mt-6 font-medium">Stav</h4>
                    <ul>
                        @foreach ($artwork->conditions as $condition)
                            <li>{{ $condition->name }}</li>
                        @endforeach
                    </ul>
                    @if ($artwork->condition_note)
                        <div class="flex text-neutral-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="mr-1 mt-[0.15rem] h-5 w-5 flex-none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>

                            <span>{{ $artwork->condition_note }}</span>
                        </div>
                    @endif
                    <h4 class="mt-6 font-medium">Evidovaná / Existujúci stupeň ochrany</h4>
                    <ul>
                        @foreach ($artwork->registrations as $registration)
                            <li>{{ $registration->name }}</li>
                        @endforeach
                    </ul>

                    <h4 class="mt-6 font-medium">Vlastník</h4>
                    <ul>
                        @foreach ($artwork->owners as $owner)
                            <li>{{ $owner->name }}</li>
                        @endforeach
                    </ul>
                    <h4 class="mt-6 font-medium">Správca</h4>
                    <ul>
                        @foreach ($artwork->maintainers as $maintainer)
                            <li>{{ $maintainer->name }}</li>
                        @endforeach
                    </ul>

                    @if ($artwork->currentLocation)
                        <hr class="neutral-100 mt-6" />

                        <h4 class="mt-6 font-medium">Adresa</h4>
                        {{ $artwork->currentLocation->address }}

                        <h4 class="mt-6 font-medium">Bližšie informácie o lokalite</h4>
                        {{ $artwork->currentLocation->description }}

                        <h4 class="mt-6 font-medium">GPS</h4>
                        @if ($artwork->currentLocation->gps_lat && $artwork->currentLocation->gps_lon)
                            {{ $artwork->currentLocation->gps_lat }}, {{ $artwork->currentLocation->gps_lon }}
                        @endif

                        <h4 class="mt-6 font-medium">Číslo parcely</h4>
                        {{ $artwork->currentLocation->plot }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ($artwork->currentLocation && $artwork->currentLocation->gps_lon && $artwork->currentLocation->gps_lat)
        <div class="h-[330px] lg:h-[500px]">
            <map-container class="h-full" :cluster="false" :zoom="16" highlight-id="{{ $artwork->id }}">
                <template v-slot:popup="{ feature }">
                    <h1 class="mb-3 text-lg font-medium">@{{ feature.properties.name }}</h1>
                    <div class="space-y-2 text-sm leading-none">
                        <p class="font-medium">@{{ feature.properties.location_address }}</p>
                        <p>@{{ feature.properties.location_description }}</p>
                        <p>
                            <a class="underline hover:no-underline"
                                :href=`https://www.google.com/maps/place/${feature.geometry.coordinates[1]},${feature.geometry.coordinates[0]}`>
                                Otvoriť v Google Maps
                            </a>
                        </p>
                    </div>
                </template>
            </map-container>
        </div>
    @endif
    <div class="mx-auto max-w-screen-3xl px-4 pb-6 pt-10 lg:px-14">
        <h3 class="mt-3 text-3xl font-medium">Ďalšie diela v okolí</h3>

        <artworks-masonry class="-mx-4 mt-4" item-selector=".grid-item" class="-mx-4 -mt-2">
            @foreach ($relatedArtworks as $a)
                <x-artwork-card :artwork="$a" class="grid-item w-1/2 p-2 sm:w-1/4 lg:p-4" />
            @endforeach
        </artworks-masonry>
    </div>
@endsection
