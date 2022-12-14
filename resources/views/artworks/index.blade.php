@extends('layouts.app')

@section('content')
    <section class="max-w-screen-3xl px-4 md:px-14 mx-auto">
        <div class="my-4">
            <search.filters-controller v-cloak
                v-slot="{ filters, query, onCheckboxChange, onOpenedFilterChange, openedFilterName }">
                <div class="hidden md:grid md:grid-cols-4">
                    <search.multi-select id="filter-borough-" label="Obvod / mestská časť" name="boroughs"
                        :is-filter-opened="openedFilterName === 'boroughs'" :on-checkbox-change="onCheckboxChange"
                        :on-opened-filter-change="onOpenedFilterChange"
                        :options="filters.boroughs?.map(option =>
                            ({
                                label: `${option.label} ${option.count} ${option.district_short}`,
                                value: option.value,
                                checked: query.boroughs.includes(option.value)
                            })
                        )">
                    </search.multi-select>
                    <search.multi-select id="filter-author-" label="Autori / Spoluautori" name="authors"
                        :is-filter-opened="openedFilterName === 'authors'" :on-checkbox-change="onCheckboxChange"
                        :on-opened-filter-change="onOpenedFilterChange"
                        :options="filters.authors?.map(option =>
                            ({
                                label: `${option.label} ${option.count}`,
                                value: option.value,
                                checked: query.authors.includes(option.value)
                            })
                        )">
                    </search.multi-select>
                    <search.multi-select id="filter-category-" label="Druh diela" name="categories"
                        :is-filter-opened="openedFilterName === 'categories'" :on-checkbox-change="onCheckboxChange"
                        :on-opened-filter-change="onOpenedFilterChange"
                        :options="filters.categories?.map(option =>
                            ({
                                label: `${option.label} ${option.count}`,
                                value: option.value,
                                checked: query.categories.includes(option.value)
                            })
                        )">
                    </search.multi-select>
                    <search.multi-select id="filter-keyword-" label="Kľúčové slová" name="keywords"
                        :is-filter-opened="openedFilterName === 'keywords'" :on-checkbox-change="onCheckboxChange"
                        :on-opened-filter-change="onOpenedFilterChange"
                        :options="filters.keywords?.map(option =>
                            ({
                                label: `${option.label} ${option.count}`,
                                value: option.value,
                                checked: query.keywords.includes(option.value)
                            })
                        )">
                    </search.multi-select>
                </div>
                <search.mobile-filter class="block md:hidden">
                    <search.multi-select id="filter-borough-" label="Obvod / mestská časť" name="boroughs"
                        :is-filter-opened="openedFilterName === 'boroughs'" :on-checkbox-change="onCheckboxChange"
                        :on-opened-filter-change="onOpenedFilterChange"
                        :options="filters.boroughs?.map(option =>
                            ({
                                label: `${option.label} ${option.count} ${option.district_short}`,
                                value: option.value,
                                checked: query.boroughs.includes(option.value)
                            })
                        )">
                    </search.multi-select>
                    <search.multi-select id="filter-author-" label="Autori / Spoluautori" name="authors"
                        :is-filter-opened="openedFilterName === 'authors'" :on-checkbox-change="onCheckboxChange"
                        :on-opened-filter-change="onOpenedFilterChange"
                        :options="filters.authors?.map(option =>
                            ({
                                label: `${option.label} ${option.count}`,
                                value: option.value,
                                checked: query.authors.includes(option.value)
                            })
                        )">
                    </search.multi-select>
                    <search.multi-select id="filter-category-" label="Druh diela" name="categories"
                        :is-filter-opened="openedFilterName === 'categories'" :on-checkbox-change="onCheckboxChange"
                        :on-opened-filter-change="onOpenedFilterChange"
                        :options="filters.categories?.map(option =>
                            ({
                                label: `${option.label} ${option.count}`,
                                value: option.value,
                                checked: query.categories.includes(option.value)
                            })
                        )">
                    </search.multi-select>
                    <search.multi-select id="filter-keyword-" label="Kľúčové slová" name="keywords"
                        :is-filter-opened="openedFilterName === 'keywords'" :on-checkbox-change="onCheckboxChange"
                        :on-opened-filter-change="onOpenedFilterChange"
                        :options="filters.keywords?.map(option =>
                            ({
                                label: `${option.label} ${option.count}`,
                                value: option.value,
                                checked: query.keywords.includes(option.value)
                            })
                        )">
                    </search.multi-select>
                </search.mobile-filter>
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
