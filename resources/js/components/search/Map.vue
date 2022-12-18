<template>
    <div
        class="relative lg:sticky top-0"
        :class="[expanded ? 'h-screen' : 'h-[270px] lg:h-screen']"
    >
        <MapContainer class="absolute inset-0" :key="componentKey" />
        <div
            class="absolute inset-0 flex items-end justify-center p-3 pointer-events-none"
        >
            <button
                @click="expanded = !expanded"
                class="bg-white bottom-3 font-medium lg:hidden p-2 pointer-events-auto sticky"
            >
                {{ expanded ? 'Zmenšiť mapu' : 'Zväčšiť mapu' }}
            </button>
        </div>
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
        expanded(value) {
            if (value) {
                this.$el.scrollIntoView({
                    behavior: 'smooth',
                });
            }
        },
    },
};
</script>
