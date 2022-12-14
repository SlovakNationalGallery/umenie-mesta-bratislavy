import { createApp } from 'vue';
import './bootstrap';
import 'masonry-layout';
import HomeMap from './components/HomeMap.vue';
import MultiSelect from './components/search/MultiSelect.vue';
import FiltersController from './components/search/FiltersController.vue';
import MobileFilter from './components/search/MobileFilter.vue';
import VueClickAway from 'vue3-click-away';

const app = createApp({});
app.use(VueClickAway);
app.component('home-map', HomeMap);
app.component('search.filters-controller', FiltersController);
app.component('search.multi-select', MultiSelect);
app.component('search.mobile-filter', MobileFilter);

app.mount('#app');
