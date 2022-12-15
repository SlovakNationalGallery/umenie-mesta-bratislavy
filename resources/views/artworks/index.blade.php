@extends('layouts.app')

@section('content')
    <search.filters-controller v-cloak
        v-slot="{ filters, query, onCheckboxChange, onOpenedFilterChange, openedFilterName }">
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

                    <search.disclosure-filter label="Autori / Spoluautor" :selected-count="query.authors.length"
                        :options="filters.authors" v-slot="{ options }">
                        <div v-for="option, index in options" :key="option.value" class="flex">
                            <input type="checkbox" :id="'filters.authors.' + index" name="authors" :value="option.value"
                                @change="onCheckboxChange" :checked="query.authors.includes(option.value)"
                                class="checked:text-neutral-800 text-red-600 h-6 w-6 rounded mr-2 focus:ring-0" />
                            <label :for="'filters.authors.' + index" class="whitespace-nowrap">
                                @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                            </label>
                        </div>
                    </search.disclosure-filter>

                    <search.disclosure-filter label="Druh diela" :selected-count="query.categories.length"
                        :options="filters.categories" v-slot="{ options }">
                        <div v-for="option, index in options" :key="option.value" class="flex">
                            <input type="checkbox" :id="'filters.categories.' + index" name="categories"
                                :value="option.value" @change="onCheckboxChange"
                                :checked="query.categories.includes(option.value)"
                                class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                            <label :for="'filters.categories.' + index" class="whitespace-nowrap">
                                @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                            </label>
                        </div>
                    </search.disclosure-filter>

                    <search.disclosure-filter label="Kľúčové slová" :selected-count="query.keywords.length"
                        :options="filters.keywords" v-slot="{ options }">
                        <div v-for="option, index in options" :key="option.value" class="flex">
                            <input type="checkbox" :id="'filters.keywords.' + index" name="keywords"
                                :value="option.value" @change="onCheckboxChange"
                                :checked="query.keywords.includes(option.value)"
                                class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                            <label :for="'filters.keywords.' + index" class="whitespace-nowrap">
                                @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                            </label>
                        </div>
                    </search.disclosure-filter>
                </div>

            </search.mobile-filter-dialog>

            {{-- Desktop filter --}}
            <headless.popover-group class="gap-x-2 hidden md:flex">
                <search.popover-filter label="Obvod / mestská časť" :selected-count="query.boroughs.length"
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
                </search.popover-filter>

                <search.popover-filter label="Autori / Spoluautori" :selected-count="query.authors.length"
                    :options="filters.authors" v-slot="{ options }">
                    <div v-for="option, index in options" :key="option.value" class="flex">
                        <input type="checkbox" :id="'filters.authors.' + index" name="authors" :value="option.value"
                            @change="onCheckboxChange" :checked="query.authors.includes(option.value)"
                            class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                        <label :for="'filters.authors.' + index" class="whitespace-nowrap">
                            @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                        </label>
                    </div>
                </search.popover-filter>

                <search.popover-filter label="Druh diela" :selected-count="query.categories.length"
                    :options="filters.categories" v-slot="{ options }">
                    <div v-for="option, index in options" :key="option.value" class="flex">
                        <input type="checkbox" :id="'filters.categories.' + index" name="categories"
                            :value="option.value" @change="onCheckboxChange"
                            :checked="query.categories.includes(option.value)"
                            class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                        <label :for="'filters.categories.' + index" class="whitespace-nowrap">
                            @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                        </label>
                    </div>
                </search.popover-filter>

                <search.popover-filter label="Kľúčové slová" :selected-count="query.keywords.length"
                    :options="filters.keywords" v-slot="{ options }">
                    <div v-for="option, index in options" :key="option.value" class="flex">
                        <input type="checkbox" :id="'filters.keywords.' + index" name="keywords" :value="option.value"
                            @change="onCheckboxChange" :checked="query.keywords.includes(option.value)"
                            class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                        <label :for="'filters.keywords.' + index" class="whitespace-nowrap">
                            @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                        </label>
                    </div>
                </search.popover-filter>
            </headless.popover-group>
        </div>

        <div class="bg-white">
            <div class="rx-4 max-w-screen-3xl md:pr-14 mx-auto mt-4 md:mt-5 flex">
                <div class="w-1/3 relative flex-shrink-0">
                    <img src="https://placeholder.pics/svg/300/DEDEDE/555555/mapa" class="w-full top-5 sticky">
                </div>

                <div class="w-2/3">
                    <search.artworks-masonry :query="query" item-selector=".grid-item">
                        @foreach ($artworks as $a)
                            <x-artwork-card :artwork="$a" class="grid-item sm:w-1/3 p-4" imgSizes="19vw" />
                        @endforeach
                    </search.artworks-masonry>
                </div>
            </div>
        </div>
    </search.filters-controller>
@endsection

