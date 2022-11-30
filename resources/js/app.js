import { createApp } from 'vue';
import './bootstrap';
import 'masonry-layout';
import ExampleComponent from './components/ExampleComponent.vue';
import Map from './components/Map.vue';

const app = createApp({});

app.component('example-component', ExampleComponent);
app.component('map-component', Map);

app.mount('#app');
