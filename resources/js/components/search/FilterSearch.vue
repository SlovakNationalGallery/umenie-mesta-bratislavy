<template>
    <div
        class="flex items-center justify-between py-1.5 px-2.5 mb-4 border border-neutral-700 rounded-full"
    >
        <input
            class="text-sm w-full focus:outline-0"
            name="f-artworks"
            id="f-artworks"
            :placeholder="props.placeholder"
            v-model="search"
        />
        <svg
            width="14"
            height="13"
            viewBox="0 0 14 13"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            class="stroke-neutral-700 stroke-[1.4px]"
        >
            <circle cx="5.5" cy="5.25" r="4.5" />
            <path d="M9 8.75L13 12.25" />
        </svg>
    </div>
    <div class="max-h-80 overflow-auto flex flex-col gap-y-2">
    <slot :searchResults="searchResults">
        <span class="text-neutral-500 italic whitespace-nowrap"
            >Žiadne možnosti</span
        >
    </slot>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const search = ref(null);
const searchResults = computed(() =>
    props.options.filter(
        (option) => !search.value || option.value.includes(search.value)
    )
);

const props = defineProps({
    options: Object,
    placeholder: String,
});
</script>
