<template>
    <Disclosure v-slot="{ open }">
        <DisclosureButton class="py-4 px-4 text-lg bg-white w-full">
            <span class="flex items-center justify-between">
                <div class="flex gap-x-2">
                    {{ props.label }}
                    <div
                        v-if="selectedCount"
                        class="mt-0.5 rounded-full bg-red-500 text-white flex h-6 w-6 text-sm items-center justify-center"
                    >
                        {{ selectedCount }}
                    </div>
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
        </DisclosureButton>
        <DisclosurePanel
            class="p-6 bg-white flex flex-col gap-y-2 max-h-96 overflow-auto"
        >
            <slot :options="options"></slot>
        </DisclosurePanel>
    </Disclosure>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue';

const props = defineProps({
    options: Object,
    label: String,
    selectedCount: Number,
});
</script>
