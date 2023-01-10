<template>
    <Popover v-slot="{ open }">
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
                :class="[
                    {
                        'mt-5 grid grid-cols-5 max-w-screen-3xl':
                            fullScreen,
                    },
                    { 'flex-col overflow-auto max-h-60 flex': !fullScreen },
                    'absolute z-10 p-6 bg-white border gap-y-2 ',
                ]"
            >
                <slot :options="props.options">
                    <span class="text-neutral-500 italic whitespace-nowrap"
                        >Žiadne možnosti</span
                    >
                </slot>
            </PopoverPanel>
        </transition>
    </Popover>
</template>

<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';

const props = defineProps({
    options: Object,
    label: String,
    selectedCount: Number,
    fullScreen: Boolean,
});
</script>
