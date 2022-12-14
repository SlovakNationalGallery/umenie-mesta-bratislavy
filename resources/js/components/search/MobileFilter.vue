<template>
    <div>
        <button @click="toggleMobileFilter" class="block md:hidden">
            zobraziť filter
        </button>
        <div
            v-if="isMobileFilterOpen"
            class="fixed z-10 top-0 left-0 h-screen w-screen bg-white"
        >
            <div>
                <span>Filter diel</span>
                <button @click="toggleMobileFilter">Skryť filter</button>
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const isMobileFilterOpen = ref(false);
const toggleMobileFilter = () =>
    (isMobileFilterOpen.value = !isMobileFilterOpen.value);
</script>
