import { createApp } from 'vue';
import './bootstrap';
import { PopoverGroup } from '@headlessui/vue';

import HomeMap from './components/HomeMap.vue';
import ArtworksMasonry from './components/ArtworksMasonry.vue';
import PopoverFilter from './components/search/PopoverFilter.vue';
import DisclosureFilter from './components/search/DisclosureFilter.vue';
import FiltersController from './components/search/FiltersController.vue';
import LoadMore from './components/search/LoadMore.vue';
import ArtworksQueryObserver from './components/search/ArtworksQueryObserver.vue';
import MapContainer from './components/MapContainer.vue';
import MobileFilter from './components/search/MobileFilter.vue';
import MobileFilterDialog from './components/search/MobileFilterDialog.vue';
import SearchMap from './components/search/Map.vue';
import ArtworkCarousel from './components/ArtworkCarousel.vue';
import FilterSearch from './components/search/FilterSearch.vue';

const app = createApp({});
app.component('headless.popover-group', PopoverGroup);
app.component('home-map', HomeMap);
app.component('map-container', MapContainer);
app.component('artworks-masonry', ArtworksMasonry);
app.component('search.filters-controller', FiltersController);
app.component('search.load-more', LoadMore);
app.component('search.map', SearchMap);
app.component('search.mobile-filter', MobileFilter);
app.component('search.mobile-filter-dialog', MobileFilterDialog);
app.component('search.popover-filter', PopoverFilter);
app.component('search.disclosure-filter', DisclosureFilter);
app.component('search.filter-search', FilterSearch);
app.component('search.artworks-query-observer', ArtworksQueryObserver);
app.component('artwork-carousel', ArtworkCarousel);

app.mount('#app');
