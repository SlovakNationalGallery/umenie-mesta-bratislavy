<template>
    <div class="relative lg:sticky top-0">
        <div :class="[expanded ? 'h-screen' : 'h-[270px] lg:h-screen']">
            <MapContainer class="h-full" :key="componentKey" />
        </div>
        <button
            @click="expanded = !expanded"
            class="-translate-x-1/2 absolute bg-white bottom-3 font-medium lg:hidden p-2 left-1/2"
        >
            {{ expanded ? 'Zmenšiť mapu' : 'Zväčšiť mapu' }}
        </button>
    </div>
</template>

<script>
import MapContainer from '../MapContainer.vue';

export default {
    components: { MapContainer },
    props: ['query'],
    data() {
        return {
            expanded: false,
            componentKey: 0,
        };
    },
    watch: {
        query() {
            this.componentKey++;
        },
    },
};
</script>
