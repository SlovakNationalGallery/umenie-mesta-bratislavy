<template>
    <div class="pointer-events-none group">
        <slot
            :handleHoverChange="handleHoverChange"
            :locationCount="locationCount"
            :filterURL="filterURL"
        ></slot>
        <transition
            enter-from-class="opacity-0"
            leave-to-class="opacity-0"
            enter-active-class="transition-opacity ease-out duration-300"
            leave-active-class="transition-opacity ease-out duration-300"
        >
            <a
                :href="filterURL"
                v-if="locationCount"
                :class="[
                    { 'w-[2.5rem] h-[2.5rem]': locationCount < 10 },
                    {
                        'w-[3.25rem] h-[3.25rem]':
                            locationCount > 9 && locationCount < 50,
                    },
                    {
                        'w-[4rem] h-[4rem]':
                            locationCount > 49 && locationCount < 100,
                    },
                    { 'w-[4.5rem] h-[4.5rem]': locationCount > 99 },
                    'absolute text-white bg-red-500 z-10 left-1/4 top-1/2 rounded-full font-semibold flex justify-center items-center pointer-events-auto',
                ]"
            >
                <span class="absolute z-10 bg-red-500">{{
                    locationCount
                }}</span>
                <div
                    :class="[
                        { 'w-[1.75rem] h-[1.75rem]': locationCount < 10 },
                        {
                            'w-[2.125rem] h-[2.125rem]':
                                locationCount > 9 && locationCount < 50,
                        },
                        {
                            'w-[2.5rem] h-[2.5rem]':
                                locationCount > 49 && locationCount < 100,
                        },
                        { 'w-[2.75rem] h-[2.75rem]': locationCount > 99 },
                        'animate-[ping_2s_ease-out_infinite] bg-red-500 rounded-full',
                    ]"
                ></div>
            </a>
        </transition>
        <div
            class="opacity-0 lg:translate-y-0 lg:group-hover:translate-y-6 duration-200 translate-y-6 lg:group-hover:opacity-100 block rounded-lg absolute drop-shadow-md bg-white py-4 px-6 z-20 whitespace-nowrap left-1/2 top-1/2"
        >
            <h4 class="text-2xl font-medium">{{ name }}</h4>
            <ul v-if="locations" class="text-xl pb-3">
                <li v-for="location in locations">
                    {{ location.borough }}{{ ` (${location.count})` }}
                </li>
            </ul>
            <ul v-if="unProcessedBoroughs.length" class="text-xl">
                Pripravujeme:
                <li
                    class="text-neutral-500"
                    v-for="unProcessedBorough in unProcessedBoroughs"
                >
                    {{ unProcessedBorough }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, computed } from 'vue';
import queryString from 'query-string';

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

const filterURL = computed(() =>
    queryString.stringifyUrl(
        { url: '/diela', query: { boroughs: DISTRICTS[props.name] } },
        {
            arrayFormat: 'bracket',
        }
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
</script>
