import { createApp } from 'vue';
import './bootstrap';
import { PopoverGroup, Disclosure, DisclosureButton, DisclosurePanel, PopoverPanel, PopoverButton, Popover } from '@headlessui/vue';

import HomeMap from './components/HomeMap.vue';
import ArtworksMasonry from './components/ArtworksMasonry.vue';
import PopoverFilter from './components/search/PopoverFilter.vue';
import DisclosureFilter from './components/search/DisclosureFilter.vue';
import TransitionOpacity from './components/search/TransitionOpacity.vue';
import FiltersController from './components/search/FiltersController.vue';
import LoadMore from './components/search/LoadMore.vue';
import ArtworksQueryObserver from './components/search/ArtworksQueryObserver.vue';
import MapContainer from './components/MapContainer.vue';
import MobileFilter from './components/search/MobileFilter.vue';
import MobileFilterDialog from './components/search/MobileFilterDialog.vue';
import SearchMap from './components/search/Map.vue';
import ArtworkCarousel from './components/ArtworkCarousel.vue';
import FilterSearch from './components/search/FilterSearch.vue';
import BackButton from './components/BackButton.vue';
import YearSlider from './components/search/YearSlider.vue';

const app = createApp({});
app.component('headless.popover-group', PopoverGroup);
app.component('headless.popover', Popover);
app.component('headless.popover-panel', PopoverPanel);
app.component('headless.popover-button', PopoverButton);
app.component('headless.disclosure', Disclosure);
app.component('headless.disclosure-button', DisclosureButton);
app.component('headless.disclosure-panel', DisclosurePanel);
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
app.component('search.year-slider', YearSlider);
app.component('search.transition-opacity', TransitionOpacity);
app.component('artwork-carousel', ArtworkCarousel);
app.component('back-button', BackButton);


app.mount('#app');
