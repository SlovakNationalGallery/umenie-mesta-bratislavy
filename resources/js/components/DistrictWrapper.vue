<template>
    <div class="pointer-events-none">
        <slot
            :isHovered="isHovered"
            :handleHoverChange="handleHoverChange"
        ></slot>
        <transition
            enter-from-class="opacity-0"
            leave-to-class="opacity-0"
            enter-active-class="transition-opacity ease-out duration-300"
            leave-active-class="transition-opacity ease-out duration-300"
        >
            <div
                v-if="!isHovered"
                class="absolute bg-red-500 w-8 h-8 left-1/4 top-1/2 rounded-full font-semibold flex justify-center items-center"
            >
                <span class="absolute z-10 bg-red-500">{{
                    locationCount
                }}</span>
                <div
                    class="animate-[ping_3s_ease-in-out_infinite] w-6 h-6 bg-red-500 rounded-full"
                ></div>
            </div>
        </transition>
        <transition
            enter-from-class="opacity-0 translate-y-6"
            leave-to-class="opacity-0 translate-y-6"
            enter-active-class="transition-all ease-out duration-300"
            leave-active-class="transition-all ease-out duration-300"
        >
            <div
                v-if="isHovered"
                :class="`rounded-lg absolute drop-shadow-md bg-white py-4 px-6 z-20 whitespace-nowrap left-1/2 top-1/2`"
            >
                <h4 class="text-2xl font-semibold">{{ title }}</h4>
                <ul class="text-xl font-medium">
                    <li v-for="location in locations">
                        {{ location.borough
                        }}{{ location.total && ` (${location.total})` }}
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, defineProps, computed } from 'vue';

const props = defineProps(['title', 'locations']);
const locationCount = computed(() =>
    props.locations.reduce((acc, currentValue) => acc + currentValue.total, 0)
);

const isHovered = ref(false);
const handleHoverChange = (value) => (isHovered.value = value);
</script>
