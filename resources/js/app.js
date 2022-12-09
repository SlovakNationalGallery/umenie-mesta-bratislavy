import { createApp } from 'vue';
import './bootstrap';
import 'masonry-layout';
import HomeMap from './components/HomeMap.vue';

const app = createApp({});

app.component('home-map', HomeMap);

app.mount('#app');
