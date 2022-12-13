import { createApp } from 'vue';
import './bootstrap';
import 'masonry-layout';
import HomeMap from './components/HomeMap.vue';
import FiltersController from './components/search/FiltersController.vue';
import MultiSelect from './components/search/MultiSelect.vue';

const app = createApp({});

app.component('home-map', HomeMap);
app.component('search.filters-controller', FiltersController);
app.component('search.multi-select', MultiSelect);

app.mount('#app');
