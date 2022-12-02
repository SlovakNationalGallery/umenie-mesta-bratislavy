import { createApp } from 'vue';
import './bootstrap';
import 'masonry-layout';
import ExampleComponent from './components/ExampleComponent.vue';
import ArtworkCarousel from './components/ArtworkCarousel.vue'
const app = createApp({});

app.component('example-component', ExampleComponent);
app.component('artwork-carousel', ArtworkCarousel);

app.mount('#app');
