import { createApp } from 'vue';
import './bootstrap';
import 'masonry-layout';
import { PopoverGroup } from '@headlessui/vue';

import HomeMap from './components/HomeMap.vue';
import ArtworksMasonry from './components/search/ArtworksMasonry.vue';
import MultiSelect from './components/search/MultiSelect.vue';
import PopoverFilter from './components/search/PopoverFilter.vue';
import FiltersController from './components/search/FiltersController.vue';
import MobileFilter from './components/search/MobileFilter.vue';
import VueClickAway from 'vue3-click-away';

const app = createApp({});
app.use(VueClickAway);
app.component('headless.popover-group', PopoverGroup);
app.component('home-map', HomeMap);
app.component('search.artworks-masonry', ArtworksMasonry);
app.component('search.filters-controller', FiltersController);
app.component('search.multi-select', MultiSelect);
app.component('search.mobile-filter', MobileFilter);
app.component('search.popover-filter', PopoverFilter);

app.mount('#app');
