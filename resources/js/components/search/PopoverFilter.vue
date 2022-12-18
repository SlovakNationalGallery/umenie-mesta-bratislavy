<template>
    <Popover v-slot="{ open }" class="relative">
        <PopoverButton
            class="py-5 px-4 outline-none text-lg"
            :class="[open ? 'bg-neutral-100' : 'bg-white']"
        >
            <span class="flex gap-x-2">
                {{ props.label }}
                <div
                    v-if="selectedCount"
                    class="mt-0.5 rounded-full bg-red-500 text-white flex h-6 w-6 text-sm items-center justify-center"
                >
                    {{ selectedCount }}
                </div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    :class="['w-6 h-6', { 'rotate-180': open }]"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                    />
                </svg>
            </span>
        </PopoverButton>

        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="translate-y-1 opacity-0"
            enter-to-class="translate-y-0 opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="translate-y-0 opacity-100"
            leave-to-class="translate-y-1 opacity-0"
        >
            <PopoverPanel
                class="absolute z-10 p-6 bg-white border"
            >
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
                    <slot :options="searchResults">
                        <span class="text-neutral-500 italic whitespace-nowrap"
                            >Žiadne možnosti</span
                        >
                    </slot>
                </div>
            </PopoverPanel>
        </transition>
    </Popover>
</template>

<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import { ref, computed } from 'vue';

const search = ref(null);
const searchResults = computed(() =>
    props.options.filter(
        (option) => !search.value || option.value.includes(search.value)
    )
);

const props = defineProps({
    options: Object,
    label: String,
    placeholder: String,
    selectedCount: Number,
});
</script>
