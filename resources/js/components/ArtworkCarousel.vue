<template>
    <div class="relative" v-if="photoMedias.length">
        <div
            v-if="photoMedias.length === 1"
            class="[&>img]:object-cover [&>img]:h-full h-96 w-full"
            v-html="photoMedias[0]"
        ></div>
        <div class="flex space-x-1" v-else-if="photoMedias.length > 1">
            <div class="h-96 w-2/3 overflow-hidden cursor-pointer">
                <div
                    class="[&>img]:object-cover hover:scale-105 transition-all duration-500 w-full h-full first:h-full"
                    v-html="photoMedias[0]"
                ></div>
            </div>
            <div class="h-96 w-1/3 overflow-hidden cursor-pointer">
                <div
                    class="[&>img]:object-cover [&>img]:h-full hover:scale-105 transition-all duration-500 w-full h-full"
                    v-html="photoMedias[1]"
                ></div>
            </div>
        </div>
        <button
            @click="handleOpenLightbox(0)"
            class="absolute min-w-max bottom-4 left-1/2 -translate-x-1/2 bg-white uppercase font-medium py-2.5 px-5 md:right-4 md:left-auto md:transform-none"
        >
            zobraziť galériu <span>({{ photoMedias.length }})</span>
        </button>
    </div>
    <div v-if="openedLightbox !== -1">
        <div
            class="z-10 bg-white left-0 top-0 fixed opacity-95 w-screen h-screen"
        />
        <div class="z-30 fixed top-10 right-10">
            <button
                @click="handleOpenLightbox(-1)"
                class="m-4 bg-neutral-800 rounded-full w-10 h-10 flex items-center justify-center stroke-white"
            >
                <svg
                    width="26"
                    height="26"
                    viewBox="0 0 26 26"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M19.3633 6.36426L6.63536 19.0922"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M6.63672 6.36426L19.3646 19.0922"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </button>
        </div>
        <div class="flex top-0 left-0 z-20 fixed w-screen h-screen">
            <div class="flex items-center justify-between w-screen">
                <button
                    :class="`${
                        openedLightbox === 0
                            ? 'bg-neutral-400'
                            : 'bg-neutral-800'
                    } m-4 rounded-full w-10 h-10 flex items-center justify-center stroke-white`"
                    @click="handleOpenLightbox(openedLightbox - 1)"
                    :disabled="openedLightbox === 0"
                >
                    <svg
                        width="21"
                        height="18"
                        viewBox="0 0 21 18"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M20.25 8.99902H1.75" />
                        <path
                            d="M9.15039 16.3996L1.75039 8.99961L9.15039 1.59961"
                        />
                    </svg>
                </button>
                <div class="pb-4 w-2/3 h-2/3">
                    <div
                        class="flex items-center h-full [&>img]:object-contain [&>img]:h-full"
                        v-html="photoMedias[openedLightbox]"
                    ></div>
                    <div
                        class="pb-4 pt-6 font-medium text-xl text-center text-neutral-800"
                    >
                        {{ artworkPhotos[openedLightbox].description }}
                    </div>
                </div>
                <button
                    :class="`${
                        openedLightbox === artworkPhotos.length - 1
                            ? 'bg-neutral-400'
                            : 'bg-neutral-800'
                    } m-4 rounded-full w-10 h-10 flex items-center justify-center stroke-white`"
                    @click="handleOpenLightbox(openedLightbox + 1)"
                    :disabled="openedLightbox === artworkPhotos.length - 1"
                >
                    <svg
                        width="21"
                        height="18"
                        viewBox="0 0 21 18"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M0.75 8.99902H19.25" />
                        <path
                            d="M11.8496 16.3996L19.2496 8.99961L11.8496 1.59961"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps(['artworkPhotos', 'photoMedias']);
const openedLightbox = ref(-1);

const handleOpenLightbox = (index) => {
    openedLightbox.value = index;
};
</script>
