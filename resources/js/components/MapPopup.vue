<template>
    <article ref="root">
        <template v-if="feature">
            <h1 class="font-medium mb-3 text-lg">
                {{ feature.properties.name }}
            </h1>
            <div class="leading-tight space-y-2 text-sm">
                <p class="font-medium">
                    {{ feature.properties.location_address }}
                </p>
                <p>{{ feature.properties.location_description }}</p>
                <p>
                    <a
                        class="underline hover:no-underline"
                        :href="feature.properties.detail_url"
                        >Otvoriť detail</a
                    >
                </p>
            </div>
        </template>
    </article>
</template>

<script>
import mapboxgl from 'mapbox-gl';

export default {
    props: ['map', 'feature'],
    data() {
        return {
            popup: new mapboxgl.Popup({
                offset: [0, 10],
                closeButton: false,
                anchor: 'top',
            }),
        };
    },
    mounted() {
        this.popup.setDOMContent(this.$refs.root);
    },
    watch: {
        feature(value) {
            this.popup.setLngLat(value.geometry.coordinates).addTo(this.map);
        },
    },
};
</script>
