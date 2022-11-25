@extends('layouts.app')

@section('content')
    <div class="py-4 flex space-x-2 bg-neutral-100">
        <div class="bg-neutral-200 border-2 border-neutral-400 w-1/3 h-60"></div>
        <div class="bg-neutral-200 border-2 border-neutral-400 w-2/3 h-60"></div>
    </div>
    <div class="p-4">
        <a href="{{ route('artworks.index') }}" class="mt-4 -ml-1 text-xs underline inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            <span class="x-ml-1">Späť na zoznam diel</span>
        </a>
        <h1 class="text-2xl font-medium mt-3">{{ $artwork->name }}</h1>
        <div class="mt-1">
            @foreach ($artwork->authors as $author)
                <a href="#TODO" class="underline">{{ $author->name }}</a>{{ $loop->last ? '' : ', ' }}
            @endforeach
            @if ($artwork->yearBuilt)
                / {{ $artwork->yearBuilt->toFormattedString() }}
            @endif
        </div>

        <article class="prose mt-6">
            {!! Str::markdown($artwork->description ?? '') !!}
        </article>

        <div class="flex gap-3 mt-4">
            @foreach ($artwork->keywords as $keyword)
                <a href="TODO" class="px-2 py-1 border border-neutral-800">{{ $keyword->keyword }}</a>
            @endforeach
        </div>

        <hr class="neutral-100 mt-6" />

        {{-- TODO: dynamically plural/singular --}}
        <h4 class="font-medium mt-8">Autori</h4>
        <ul>
            @foreach ($artwork->authors as $author)
                <li><a href="TODO" class="underline">{{ $author->name }}</a></li>
            @endforeach
        </ul>

        <h4 class="font-medium mt-5">Spoluautori</h4>
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

        <hr class="neutral-100 mt-6" />

        <h4 class="font-medium mt-6">Druh</h4>
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
    <div class="mt-8 bg-neutral-200 border-2 border-neutral-400 h-80 flex items-center justify-center">mapa</div>
    <div class="pt-10 pb-6 px-4 bg-neutral-100">
        <h3 class="text-3xl font-medium mt-3">Ďalšie diela v okolí</h3>

        {{-- TODO --}}
        <div class="mt-4 -mx-4 px-4">
            <x-artwork-card :artwork="$artwork" />
        </div>
    </div>
@endsection
