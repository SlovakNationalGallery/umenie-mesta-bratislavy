<template>
    <div>
        <div class="h-full" ref="mapEl"></div>
        <div class="hidden">
            <div ref="popup">
                <slot
                    v-if="popupFeature"
                    name="popup"
                    :feature="popupFeature"
                ></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import mapboxgl from 'mapbox-gl';
import { onMounted, ref, watch, computed, onUnmounted, nextTick } from 'vue';
import { stringifyUrl } from './search/FiltersController.vue';

const props = defineProps({
    zoom: {
        type: Number,
    },
    cluster: {
        type: Boolean,
        default: true,
    },
    highlightId: {
        type: String,
        default: null,
    },
    query: {
        type: Object,
        default: {},
    },
});

const query = computed(() => props.query);

const popupFeature = ref(null);
const mapEl = ref(null);
const mapRef = ref(null);
const popup = ref(null);
const resizeObserver = ref(null);
const dataLoading = axios.get(
    `/api/artworks/map-points${window.location.search}`,
);

watch(query, async (newQuery) => {
    axios
        .get(
            stringifyUrl({
                url: '/api/artworks/map-points',
                query: newQuery,
            }),
        )
        .then(({ data }) => {
            mapRef.value.getSource('artworks').setData(data);
            if (!data.features.length) return;
            mapRef.value.fitBounds(
                getBounds(
                    data.features.map(
                        (feature) => feature.geometry.coordinates,
                    ),
                ),
                { padding: 50, linear: true },
            );
        });
});

onMounted(() => {
    const mapLoading = new Promise((resolve, reject) => {
        new mapboxgl.Map({
            language: 'sk-SK',
            container: mapEl.value,
            style:
                import.meta.env.VITE_MAPBOX_STYLE ||
                'mapbox://styles/mapbox/streets-v11',
        })
            .on('load', function () {
                resolve(this);
            })
            .on('error', reject);
    });

    Promise.all([dataLoading, mapLoading]).then(loaded);
});

onUnmounted(() => {
    resizeObserver.value.disconnect();
});

const onGeolocateControlLoaded = (ctrlGeolocate) => {
    const ctrlGeolocateIcon = ctrlGeolocate.querySelector(
        '.mapboxgl-ctrl-geolocate .mapboxgl-ctrl-icon',
    );

    if (ctrlGeolocate) ctrlGeolocate.setAttribute('aria-label', 'Lokalizuj ma');
    if (ctrlGeolocateIcon)
        ctrlGeolocateIcon.setAttribute('title', 'Lokalizuj ma');
};

const loaded = ([{ data }, map]) => {
    map.addSource('artworks', {
        type: 'geojson',
        data,
        generateId: true,
        cluster: props.cluster,
        clusterRadius: 36,
    })
        .addLayer(clusterLayer)
        .addLayer(clusterCountLayer)
        .addLayer(unclusteredPointsLayer)
        .addLayer(detailLayer)
        .on('click', 'clusters', zoomCluster)
        .on('click', 'unclustered-points', (e) => openPopup(e.features[0]))
        .on('mouseenter', 'clusters', setCursorPointer)
        .on('mouseleave', 'clusters', unsetCursorPointer)
        .on('mouseenter', 'unclustered-points', setCursorPointer)
        .on('mouseleave', 'unclustered-points', unsetCursorPointer)
        .on('mouseenter', 'detail', setCursorPointer)
        .on('mouseleave', 'detail', unsetCursorPointer)
        .addControl(
            new mapboxgl.NavigationControl({
                showCompass: false,
            }),
            'top-left',
        )
        .addControl(new mapboxgl.GeolocateControl(), 'top-right');

    const checkGeolocateControlLoaded = () => {
        const el = document.querySelector('.mapboxgl-ctrl-geolocate');
        if (el) {
            onGeolocateControlLoaded(el);
        } else {
            setTimeout(checkGeolocateControlLoaded, 100);
        }
    };

    checkGeolocateControlLoaded();

    map.scrollZoom.disable();
    mapRef.value = map;
    observeResize(map);

    if (props.highlightId) {
        const highlightedFeature = data.features.find(
            (feature) => feature.properties.id === props.highlightId,
        );

        if (!highlightedFeature) return;

        const [centerX, centerY] = highlightedFeature.geometry.coordinates;
        map.easeTo({
            center: [
                centerX,
                parseFloat(centerY) + 0.0006, // adjust so that the popup fits
            ],
            zoom: props.zoom,
            duration: 0,
        });

        openPopup(highlightedFeature);

        return;
    }

    if (!data.features.length) return;
    const bounds = getBounds(
        data.features.map((feature) => feature.geometry.coordinates),
    );

    map.fitBounds(bounds, { padding: 50, duration: 0, maxZoom: 16 });
};

const getBounds = (points) => {
    const bounds = new mapboxgl.LngLatBounds();
    points.forEach(function (point) {
        bounds.extend(point);
    });
    return bounds;
};

const observeResize = (map) => {
    resizeObserver.value = new ResizeObserver((entries) => {
        entries.forEach(() => {
            map.resize();
        });
    }).observe(mapEl.value);
};

const clusterLayer = {
    id: 'clusters',
    type: 'circle',
    source: 'artworks',
    filter: ['has', 'point_count'],
    paint: {
        'circle-color': '#F94D46', // red-500
        // Using step expressions (https://docs.mapbox.com/mapbox-gl-js/style-spec/#expressions-step)
        // with three steps to implement three types of circles
        'circle-radius': [
            'step',
            ['get', 'point_count'],
            20,
            10,
            26,
            50,
            32,
            100,
            36,
        ],
    },
};

const clusterCountLayer = {
    id: 'cluster-count',
    type: 'symbol',
    source: 'artworks',
    filter: ['has', 'point_count'],
    layout: {
        'text-field': '{point_count_abbreviated}',
        'text-font': ['Denim SemiBold', 'Arial Unicode MS Bold'],
        'text-size': 16,
    },
    paint: {
        'text-translate': [0, 2],
        'text-color': '#ffffff',
    },
};

const unclusteredPointsLayer = {
    id: 'unclustered-points',
    type: 'symbol',
    source: 'artworks',
    filter: ['all', ['!', ['has', 'point_count']]],
    layout: {
        'icon-allow-overlap': true,
        'icon-image': ['concat', 'artwork-', ['get', 'icon']],
        'icon-offset': [0, -20.25],
    },
};

const detailLayer = {
    id: 'detail',
    type: 'symbol',
    source: 'artworks',
    filter: ['==', ['get', 'id'], props.highlightId],
    layout: {
        'icon-allow-overlap': true,
        'icon-image': ['concat', 'artwork-', ['get', 'icon'], '-detail'],
        'icon-offset': [0, -20.25],
    },
};

const zoomCluster = function (e) {
    const features = this.queryRenderedFeatures(e.point, {
        layers: ['clusters'],
    });
    const clusterId = features[0].properties.cluster_id;
    this.getSource('artworks').getClusterExpansionZoom(
        clusterId,
        (err, zoom) => {
            if (err) return;

            this.easeTo({
                center: features[0].geometry.coordinates,
                zoom,
            });
        },
    );
};

const openPopup = function (feature) {
    popupFeature.value = feature;
    nextTick(() => {
        new mapboxgl.Popup({
            focusAfterOpen: false,
            maxWidth: '315px',
        })
            .setLngLat(popupFeature.value.geometry.coordinates)
            .setHTML(popup.value.outerHTML)
            .addTo(mapRef.value);
    });
};

const setCursorPointer = function () {
    this.getCanvas().classList.add('cursor-pointer');
};

const unsetCursorPointer = function () {
    this.getCanvas().classList.remove('cursor-pointer');
};
</script>
