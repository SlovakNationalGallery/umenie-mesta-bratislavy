@extends('layouts.app')

@section('content')
    <section class="max-w-screen-3xl px-4 md:px-14 mx-auto">
        <div class="my-4">
            <search.filters-controller v-cloak v-slot="{ filters, query, onCheckboxChange }">
                <div class="grid grid-cols-4">
                    <search.multi-select :options="filters.boroughs" v-slot="{ options }">
                        <div v-for="option in filters.boroughs" :key="option.value">
                            <input :id="`filter-borough-${option.value}`" type="checkbox" name="boroughs"
                                :value="option.value" @change="onCheckboxChange"
                                :checked="query.boroughs.includes(option.value)" />
                            <label :for="`filter-borough-${option.value}`">
                                @{{ option.label }} (@{{ option.count }}) (@{{ option.district_short }})
                            </label>
                        </div>
                    </search.multi-select>
                    <search.multi-select :options="filters.authors" v-slot="{ options }">
                        <div v-for="option in filters.authors" :key="option.value">
                            <input :id="`filter-author-${option.value}`" type="checkbox" name="authors"
                                :value="option.value" @change="onCheckboxChange"
                                :checked="query.authors.includes(option.value)" />
                            <label :for="`filter-author-${option.value}`">
                                @{{ option.label }} (@{{ option.count }})
                            </label>
                        </div>
                    </search.multi-select>
                    <search.multi-select :options="filters.categories" v-slot="{ options }">
                        <div v-for="option in options" :key="option.value">
                            <input :id="`filter-category-${option.value}`" type="checkbox" name="categories"
                                :value="option.value" @change="onCheckboxChange"
                                :checked="query.categories.includes(option.value)" />
                            <label :for="`filter-category-${option.value}`">
                                @{{ option.label }} (@{{ option.count }})
                            </label>
                        </div>
                    </search.multi-select>
                    <search.multi-select :options="filters.keywords" v-slot="{ options }">
                        <div v-for="option in options" :key="option.value">
                            <input :id="`filter-keyword-${option.value}`" type="checkbox" name="keywords"
                                :value="option.value" @change="onCheckboxChange"
                                :checked="query.keywords.includes(option.value)" />
                            <label :for="`filter-keyword-${option.value}`">
                                @{{ option.label }} (@{{ option.count }})
                            </label>
                        </div>
                    </search.multi-select>

                </div>
            </search.filters-controller>
        </div>
        <div class="flex">
            <div class="w-1/3 relative flex-shrink-0">
                <img src="https://placeholder.pics/svg/300/DEDEDE/555555/mapa" class="w-full top-5 sticky">
            </div>

            <div class="w-2/3">
                <div class="-mt-4 -mr-4" data-masonry='{ "itemSelector": ".grid-item" }'>
                    @foreach ($artworks as $a)
                        <x-artwork-card :artwork="$a" class="grid-item sm:w-1/3 p-4" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
