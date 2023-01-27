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
        <div class="absolute top-12 right-2.5">
            <button
                id="legend"
                @click="showLegend = true"
                title="Zobraziť legendu"
                class="w-[29px] h-[29px] mapboxgl-ctrl mapboxgl-ctrl-group hover:bg-[#f2f2f2] flex items-center justify-center text-[#333]"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="w-5 h-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"
                    />
                </svg>
            </button>
        </div>

        <TransitionRoot appear :show="showLegend" as="template">
            <Dialog as="div" @close="showLegend = false" class="relative z-30">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-neutral-800 bg-opacity-30" />
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
                                class="transform bg-white text-left align-middle shadow-xl transition-all"
                            >
                                <div class="flex justify-between items-center">
                                    <DialogTitle
                                        as="h3"
                                        class="text-2xl font-semibold text-neutral-800 p-6"
                                    >
                                        Kategórie diel v mape
                                    </DialogTitle>
                                    <button
                                        type="button"
                                        @click="showLegend = false"
                                        class="p-6"
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
                                <slot name="categories-modal"></slot>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script>
import MapContainer from '../MapContainer.vue';
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue';

export default {
    components: {
        MapContainer,
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
    },
    props: ['query'],
    data() {
        return {
            expanded: false,
            showLegend: false,
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
