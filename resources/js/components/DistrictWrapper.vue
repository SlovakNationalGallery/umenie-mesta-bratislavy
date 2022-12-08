<template>
    <div class="pointer-events-none">
        <slot
            :handleHoverChange="handleHoverChange"
            :locationCount="locationCount"
        ></slot>
        <transition
            enter-from-class="opacity-0"
            leave-to-class="opacity-0"
            enter-active-class="transition-opacity ease-out duration-300"
            leave-active-class="transition-opacity ease-out duration-300"
        >
            <div
                v-if="!isHovered && locationCount"
                :class="[
                    { 'w-[2.5rem] h-[2.5rem]': locationCount < 10 },
                    { 'w-[3.25rem] h-[3.25rem]': locationCount < 50 },
                    { 'w-[3.25rem] h-[3.25rem]': locationCount < 100 },
                    { 'w-[5.625rem] h-[5.625rem]': locationCount > 99 },
                    'absolute text-white bg-red-500 left-1/4 top-1/2 rounded-full font-semibold flex justify-center items-center',
                ]"
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
                class="rounded-lg absolute drop-shadow-md bg-white py-4 px-6 z-20 whitespace-nowrap left-1/2 top-1/2"
            >
                <h4 class="text-2xl font-medium">{{ name }}</h4>
                <ul class="text-xl pb-3">
                    <li v-for="location in locations">
                        {{ location.borough }}{{ ` (${location.count})` }}
                    </li>
                </ul>
                <ul class="text-xl">
                    Pripravujeme:
                    <li
                        class="text-neutral-500"
                        v-for="unProcessedBorough in unProcessedBoroughs"
                    >
                        {{ unProcessedBorough }}
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, defineProps, computed } from 'vue';

const DISTRICTS = {
    'Bratislava I': ['Staré Mesto'],
    'Bratislava II': ['Ružinov', 'Vrakuňa', 'Podunajské Biskupice'],
    'Bratislava III': ['Nové Mesto', 'Rača', 'Vajnory'],
    'Bratislava IV': [
        'Karlova Ves',
        'Dúbravka',
        'Lamač',
        'Devín',
        'Devínska Nová Ves',
        'Záhorská Bystrica',
    ],
    'Bratislava V': ['Petržalka', 'Jarovce', 'Rusovce', 'Čunovo'],
};

const props = defineProps(['name', 'locations']);
const locationCount = computed(
    () =>
        props.locations &&
        props.locations.reduce(
            (acc, currentValue) => acc + currentValue.count,
            0
        )
);

const unProcessedBoroughs = computed(() =>
    DISTRICTS[props.name].filter(
        (district) =>
            !props.locations ||
            !props.locations
                .map((location) => location.borough)
                .includes(district)
    )
);

const isHovered = ref(false);
const handleHoverChange = (value) => (isHovered.value = value);
</script>
