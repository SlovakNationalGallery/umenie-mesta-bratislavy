import { createApp } from 'vue';
import './bootstrap';
import 'masonry-layout';
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({});

app.component('example-component', ExampleComponent);

app.mount('#app');
