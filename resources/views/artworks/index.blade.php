@extends('layouts.app')

@section('content')
    <search.filters-controller v-cloak v-slot="{ filters, query, onCheckboxChange, artworks, isFetching }">
        <div class="max-w-screen-3xl px-4 md:px-14 mx-auto">
            {{-- Mobile filter --}}
            <search.mobile-filter-dialog
                :active-count="query.boroughs.length + query.authors.length + query.categories.length + query.keywords.length">
                <div class="bg-neutral-100 p-4 flex flex-col gap-y-3">
                    <search.disclosure-filter label="Obvod / mestská časť" :selected-count="query.boroughs.length"
                        :options="filters.boroughs" v-slot="{ options }">
                        <div v-for="option, index in options" :key="option.value" class="flex">
                            <input type="checkbox" :id="'filters.boroughs.' + index" name="boroughs" :value="option.value"
                                @change="onCheckboxChange" :checked="query.boroughs.includes(option.value)"
                                class="checked:text-neutral-800 text-red-600 h-6 w-6 rounded mr-2 focus:ring-0" />
                            <label :for="'filters.boroughs.' + index" class="whitespace-nowrap">
                                @{{ option.label }} (@{{ option.district_short }})
                                <span class="font-semibold">(@{{ option.count }})</span>
                            </label>
                        </div>
                    </search.disclosure-filter>

                    <search.disclosure-filter label="Autori*ky / Spoluautori*ky" :selected-count="query.authors.length"
                        :options="filters.authors" v-slot="{ options }">
                        <search.filter-search placeholder="Napíšte meno autora / autorky" :options="options"
                            v-slot="{ searchResults }">
                            <div v-for="option, index in searchResults" :key="option.value" class="flex">
                                <input type="checkbox" :id="'filters.authors.' + index" name="authors"
                                    :value="option.value" @change="onCheckboxChange"
                                    :checked="query.authors.includes(option.value)"
                                    class="checked:text-neutral-800 text-red-600 h-6 w-6 rounded mr-2 focus:ring-0" />
                                <label :for="'filters.authors.' + index" class="whitespace-nowrap">
                                    @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                                </label>
                            </div>
                        </search.filter-search>
                    </search.disclosure-filter>

                    <search.disclosure-filter label="Druh diela" :selected-count="query.categories.length"
                        :options="filters.categories" v-slot="{ options }">
                        <search.filter-search placeholder="Zadajte druh diela" :options="options"
                            v-slot="{ searchResults }">
                            <div v-for="option, index in searchResults" :key="option.value" class="flex">
                                <input type="checkbox" :id="'filters.categories.' + index" name="categories"
                                    :value="option.value" @change="onCheckboxChange"
                                    :checked="query.categories.includes(option.value)"
                                    class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                                <label :for="'filters.categories.' + index" class="whitespace-nowrap">
                                    @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                                </label>
                            </div>
                        </search.filter-search>
                    </search.disclosure-filter>

                    <search.disclosure-filter label="Kľúčové slová" :selected-count="query.keywords.length"
                        :options="filters.keywords" v-slot="{ options }">
                        <search.filter-search placeholder="Zadajte kĺúčové slovo" :options="options"
                            v-slot="{ searchResults }">
                            <div v-for="option, index in searchResults" :key="option.value" class="flex">
                                <input type="checkbox" :id="'filters.keywords.' + index" name="keywords"
                                    :value="option.value" @change="onCheckboxChange"
                                    :checked="query.keywords.includes(option.value)"
                                    class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                                <label :for="'filters.keywords.' + index" class="whitespace-nowrap">
                                    @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                                </label>
                            </div>
                        </search.filter-search>
                    </search.disclosure-filter>
                </div>

            </search.mobile-filter-dialog>

            {{-- Desktop filter --}}
            <div class="flex justify-between">
                <headless.popover-group class="gap-x-2 hidden md:flex">
                    <search.popover-filter label="Obvod / mestská časť" :selected-count="query.boroughs.length"
                        :options="filters.boroughs" v-slot="{ options }">
                        <div class="max-h-80 overflow-auto flex flex-col gap-y-2">
                            <div v-for="option, index in options" :key="option.value" class="flex">
                                <input type="checkbox" :id="'filters.boroughs.' + index" name="boroughs"
                                    :value="option.value" @change="onCheckboxChange"
                                    :checked="query.boroughs.includes(option.value)"
                                    class="checked:text-neutral-800 text-red-600 h-6 w-6 rounded mr-2 focus:ring-0" />
                                <label :for="'filters.boroughs.' + index" class="whitespace-nowrap">
                                    @{{ option.label }} (@{{ option.district_short }})
                                    <span class="font-semibold">(@{{ option.count }})</span>
                                </label>
                            </div>
                        </div>
                    </search.popover-filter>
                    <search.popover-filter label="Autori*ky / Spoluautori*ky" :selected-count="query.authors.length"
                        :options="filters.authors" v-slot="{ options }">
                        <search.filter-search placeholder="Napíšte meno autora / autorky" :options="options"
                            v-slot="{ searchResults }">
                            <div v-for="option, index in searchResults" :key="option.value" class="flex">
                                <input type="checkbox" :id="'filters.authors.' + index" name="authors"
                                    :value="option.value" @change="onCheckboxChange"
                                    :checked="query.authors.includes(option.value)"
                                    class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                                <label :for="'filters.authors.' + index" class="whitespace-nowrap">
                                    @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                                </label>
                            </div>
                        </search.filter-search>
                    </search.popover-filter>

                    <search.popover-filter label="Druh diela" :selected-count="query.categories.length"
                        :options="filters.categories" v-slot="{ options }">
                        <search.filter-search placeholder="Zadajte druh diela" :options="options"
                            v-slot="{ searchResults }">
                            <div v-for="option, index in options" :key="option.value" class="flex">
                                <input type="checkbox" :id="'filters.categories.' + index" name="categories"
                                    :value="option.value" @change="onCheckboxChange"
                                    :checked="query.categories.includes(option.value)"
                                    class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                                <label :for="'filters.categories.' + index" class="whitespace-nowrap">
                                    @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                                </label>
                            </div>
                        </search.filter-search>
                    </search.popover-filter>

                    <search.popover-filter label="Kľúčové slová" :selected-count="query.keywords.length"
                        :options="filters.keywords" v-slot="{ options }">
                        <search.filter-search placeholder="Zadajte kľúčové slovo" :options="options"
                            v-slot="{ searchResults }">
                            <div v-for="option, index in options" :key="option.value" class="flex">
                                <input type="checkbox" :id="'filters.keywords.' + index" name="keywords"
                                    :value="option.value" @change="onCheckboxChange"
                                    :checked="query.keywords.includes(option.value)"
                                    class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                                <label :for="'filters.keywords.' + index" class="whitespace-nowrap">
                                    @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                                </label>
                            </div>
                        </search.filter-search>
                    </search.popover-filter>
                </headless.popover-group>

                <div v-if="artworks.length" class="mt-5 hidden md:block transition-opacity"
                    :class="{ 'opacity-50': isFetching }">
                    <span v-if="artworks.length === 1">
                        Filtrom zodpovedá <span class="font-semibold">@{{ artworks.length }} dielo</span>
                    </span>
                    <span v-else-if="artworks.length < 5">
                        Filtrom zodpovedajú <span class="font-semibold">@{{ artworks.length }} diela</span>
                    </span>
                    <span v-else>
                        Filtrom zodpovedá <span class="font-semibold">@{{ artworks.length }} diel</span>
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white min-h-screen">
            <div class="md:px-14 px-4 max-w-screen-3xl mx-auto mt-4 md:mt-5 md:flex">
                <div class="-mx-4 md:-ml-14 md:mr-14 md:w-1/3 relative flex-shrink-0">
                    <search.map class="relative lg:sticky top-0" :query="query"></search.map>
                </div>

                <div class="md:flex-grow mt-8 md:mt-0">
                    <div v-if="artworks.length" class="mt-5 md:hidden">
                        <span v-if="artworks.length === 1">
                            Filtrom zodpovedá <span class="font-semibold">@{{ artworks.length }} dielo</span>
                        </span>
                        <span v-else-if="artworks.length < 5">
                            Filtrom zodpovedajú <span class="font-semibold">@{{ artworks.length }} diela</span>
                        </span>
                        <span v-else>
                            Filtrom zodpovedá <span class="font-semibold">@{{ artworks.length }} diel</span>
                        </span>
                    </div>
                    <artworks-masonry :query="query" item-selector=".grid-item" class="-mx-2 mt-4 md:-mx-8">
                        @foreach ($artworks as $a)
                            <x-artwork-card :artwork="$a" class="grid-item w-1/2 sm:w-1/3 p-2 md:p-4"
                                imgSizes="19vw" />
                        @endforeach
                    </artworks-masonry>
                </div>
            </div>
        </div>
    </search.filters-controller>
@endsection
