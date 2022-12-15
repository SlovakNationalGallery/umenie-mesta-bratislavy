import { createApp } from 'vue';
import './bootstrap';
import 'masonry-layout';
import { PopoverGroup } from '@headlessui/vue';

import HomeMap from './components/HomeMap.vue';
import ArtworksMasonry from './components/search/ArtworksMasonry.vue';
import MultiSelect from './components/search/MultiSelect.vue';
import PopoverFilter from './components/search/PopoverFilter.vue';
import DisclosureFilter from './components/search/DisclosureFilter.vue';
import FiltersController from './components/search/FiltersController.vue';
import MobileFilter from './components/search/MobileFilter.vue';
import MobileFilterDialog from './components/search/MobileFilterDialog.vue';

const app = createApp({});
app.component('headless.popover-group', PopoverGroup);
app.component('home-map', HomeMap);
app.component('search.artworks-masonry', ArtworksMasonry);
app.component('search.filters-controller', FiltersController);
app.component('search.multi-select', MultiSelect);
app.component('search.mobile-filter', MobileFilter);
app.component('search.mobile-filter-dialog', MobileFilterDialog);
app.component('search.popover-filter', PopoverFilter);
app.component('search.disclosure-filter', DisclosureFilter);

app.mount('#app');
