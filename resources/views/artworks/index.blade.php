@extends('layouts.app')
@section('content')
    <search.filters-controller v-cloak v-slot="{ filters, query, onCheckboxChange, artworks, isFetching, ...controller }">
        <div class="max-w-screen-3xl px-4 lg:px-14 mx-auto relative">
            {{-- Mobile filter --}}
            <search.mobile-filter-dialog
                :active-count="query.boroughs.length + query.authors.length + query.categories.length + query.keywords.length">
                <div class="bg-neutral-100 p-4 flex flex-col gap-y-3">
                    <search.disclosure-filter label="Obvod / mestská časť" :selected-count="query.boroughs.length"
                        :options="filters.boroughs" v-slot="{ options }">
                        <div v-for="option, index in options" :key="option.value" class="flex">
                            <input type="checkbox" :id="'filters.boroughs.' + index" name="boroughs" :value="option.value"
                                @change="onCheckboxChange" :checked="query.boroughs.includes(option.value)" class="hidden" />
                            <label class="w-full border border-neutral-100 flex items-center justify-start rounded h-16"
                                :for="'filters.boroughs.' + index">
                                <div class="flex items-center justify-center h-full w-16 flex-none">
                                    <img class="w-full h-full p-1" :src="option.icon_src" />
                                </div>
                                <span class="py-5 font-semibold pr-1">
                                    @{{ option.district_short }}
                                    @{{ option.label }}
                                    (@{{ option.count }})
                                </span>
                                <div v-if="query.boroughs.includes(option.value)"
                                    class="ml-auto mr-4 bg-red-500 w-[1.625rem] h-[1.625rem] rounded-full flex justify-center items-center flex-none">
                                    <svg class="stroke-neutral-800 stroke-2" width="14" height="10"
                                        viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.818 1L4.818 9L1.18164 5.36364" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </label>
                        </div>
                    </search.disclosure-filter>

                    <search.disclosure-filter label="Autori*ky / Spoluautori*ky" :selected-count="query.authors.length"
                        :options="filters.authors" v-slot="{ options }">
                        <search.filter-search :options="options" v-slot="{ searchResults }">
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
                        <search.filter-search :options="options" v-slot="{ searchResults }">
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
                        <search.filter-search :options="options" v-slot="{ searchResults }">
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
                <headless.popover-group class="gap-x-1 hidden lg:flex">
                    <search.popover-filter label="Obvod / mestská časť" :selected-count="query.boroughs.length"
                        :options="filters.boroughs" :full-screen="true" v-slot="{ options }">
                        <div v-for="option, index in options" :key="option.value"
                            class="flex items-center justify-center w-full border border-neutral-100 py-4">
                            <input type="checkbox" :id="'filters.boroughs.' + index" name="boroughs"
                                :value="option.value" @change="onCheckboxChange"
                                :checked="query.boroughs.includes(option.value)" class="hidden" />
                            <label :for="'filters.boroughs.' + index" class="w-full">
                                <div class="flex flex-col items-center justify-center w-full">
                                    <div class="relative">
                                        <img :src="option.icon_src" class="h-16" />
                                        <div v-if="query.boroughs.includes(option.value)"
                                            class="absolute z-20 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 flex items-center justify-center bg-red-500 w-[1.625rem] h-[1.625rem] rounded-full">
                                            <svg class="stroke-neutral-800 stroke-2" width="14" height="10"
                                                viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.818 1L4.818 9L1.18164 5.36364" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="pt-3">
                                        @{{ option.district_short }}
                                    </span>
                                    <span class="font-medium text-center px-1">
                                        @{{ option.label }} (@{{ option.count }})
                                    </span>
                                </div>
                            </label>
                        </div>
                    </search.popover-filter>
                    <search.popover-filter label="Autori*ky / Spoluautori*ky" :selected-count="query.authors.length"
                        :options="filters.authors" v-slot="{ options }">
                        <search.filter-search :options="options" v-slot="{ searchResults }">
                            <div v-for="option, index in searchResults" :key="option.value" class="flex">
                                <input type="checkbox" :id="'filters.authors.' + index" name="authors"
                                    :value="option.value" @change="onCheckboxChange"
                                    :checked="query.authors.includes(option.value)"
                                    class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                                <label :for="'filters.authors.' + index" class="whitespace-nowrap pr-4">
                                    @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                                </label>
                            </div>
                        </search.filter-search>
                    </search.popover-filter>

                    <search.popover-filter label="Druh diela" :selected-count="query.categories.length"
                        :options="filters.categories" v-slot="{ options }">
                        <search.filter-search :options="options" v-slot="{ searchResults }">
                            <div v-for="option, index in searchResults" :key="option.value" class="flex">
                                <input type="checkbox" :id="'filters.categories.' + index" name="categories"
                                    :value="option.value" @change="onCheckboxChange"
                                    :checked="query.categories.includes(option.value)"
                                    class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                                <label :for="'filters.categories.' + index" class="whitespace-nowrap pr-4">
                                    @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                                </label>
                            </div>
                        </search.filter-search>
                    </search.popover-filter>

                    <search.popover-filter label="Kľúčové slová" :selected-count="query.keywords.length"
                        :options="filters.keywords" v-slot="{ options }">
                        <search.filter-search :options="options" v-slot="{ searchResults }">
                            <div v-for="option, index in searchResults" :key="option.value" class="flex">
                                <input type="checkbox" :id="'filters.keywords.' + index" name="keywords"
                                    :value="option.value" @change="onCheckboxChange"
                                    :checked="query.keywords.includes(option.value)"
                                    class="checked:text-neutral-800 text-neutral-200 h-6 w-6 rounded mr-2 focus:ring-0" />
                                <label :for="'filters.keywords.' + index" class="whitespace-nowrap pr-4">
                                    @{{ option.label }} <span class="font-semibold">(@{{ option.count }})</span>
                                </label>
                            </div>
                        </search.filter-search>
                    </search.popover-filter>
                </headless.popover-group>

                <div v-if="artworks.length" class="mt-5 hidden lg:block transition-opacity"
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
            <div class="lg:px-14 px-4 max-w-screen-3xl mx-auto mt-4 lg:mt-5 lg:flex">
                <div class="-mx-4 lg:-ml-14 lg:mr-14 lg:w-1/3 relative flex-shrink-0">
                    <search.map :query="query"></search.map>
                </div>

                <div class="lg:flex-grow mt-8 lg:mt-0">
                    <div v-if="artworks.length" class="mt-5 lg:hidden">
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
                    <div class="flex -mx-2 lg:-mx-4 gap-3 mt-10 flex-wrap">
                        <button v-for="selection in controller.filterSelections"
                            class="border rounded-sm uppercase text-xs font-semibold tracking-wide border-neutral-800 flex items-center px-3 py-2"
                            @click="controller.removeSelection(selection)" v-key="`${selection.name}${selection.value}`">
                            @{{ selection.label }}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <artworks-masonry :query="query" item-selector=".grid-item" class="-mx-2 mt-4 lg:-mx-8"
                        :initial-has-next="true">
                        @foreach ($artworks as $a)
                            <x-artwork-card :artwork="$a" class="grid-item w-1/2 sm:w-1/3 p-2 lg:p-4"
                                imgSizes="19vw" />
                        @endforeach
                    </artworks-masonry>
                </div>
            </div>
        </div>
    </search.filters-controller>
@endsection

