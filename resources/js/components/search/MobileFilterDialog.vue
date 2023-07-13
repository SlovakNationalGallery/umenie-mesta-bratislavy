<template>
    <div>
        <button
            type="button"
            @click="openModal"
            class="flex uppercase p-3 justify-center border border-neutral-800 w-full gap-x-2 items-center lg:hidden"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1"
                stroke="currentColor"
                class="w-8 h-8 -my-2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"
                />
            </svg>
            <span>Zobraziť filter</span>
            <div
                v-if="activeCount"
                class="mt-0.5 rounded-full bg-red-500 text-white flex h-6 w-6 text-sm items-center justify-center"
            >
                {{ activeCount }}
            </div>
        </button>
    </div>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="absolute flex flex-col inset-x-0 bottom-0 top-10 transform bg-white text-left align-middle shadow-xl transition-all"
                        >
                            <div class="flex justify-between items-center">
                                <DialogTitle
                                    as="h3"
                                    class="text-2xl font-semibold text-neutral-800 p-5"
                                >
                                    Filter diel
                                </DialogTitle>
                                <div class="flex items-center">
                                    <button
                                        class="underline text-xs p-2"
                                        v-if="activeCount"
                                        @click="$emit('clear')"
                                    >
                                        vymazať filtre
                                    </button>
                                    <button
                                        type="button"
                                        @click="closeModal"
                                        class="p-2"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.75"
                                            stroke="currentColor"
                                            class="w-8 h-8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <slot></slot>
                            <div
                                v-if="activeCount"
                                class="bg-neutral-100 bottom-0 sticky left-0 right-0 width-screen py-2 px-4 drop-shadow-[0px_-3px_10px_rgba(0,0,0,0.15)]"
                            >
                                <button
                                    @click="closeModal"
                                    class="bg-red-500 uppercase text-white w-full text-center py-4 font-medium"
                                >
                                    zobraziť diela
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue';
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue';

const props = defineProps({ activeCount: Number });

const isOpen = ref(false);

function closeModal() {
    isOpen.value = false;
}
function openModal() {
    isOpen.value = true;
}
</script>
