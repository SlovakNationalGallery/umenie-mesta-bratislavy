<template>
    <div class="relative">
        <div class="overflow-x-auto">
            <div class="py-4 flex min-w-max space-x-2 bg-neutral-100">
                <div
                    v-for="(artworkPhoto, photoIndex) in artworkPhotos"
                    class="relative bg-neutral-200 border-2 border-neutral-400 w-60 h-60"
                >
                    {{ artworkPhoto }}
                    <button
                        @click="handleOpenLightbox(photoIndex)"
                        class="absolute left-1/2 top-1/2"
                    >
                        zoom
                    </button>
                </div>
            </div>
        </div>
        <div
            class="absolute flex align-center bottom-4 right-4 opacity-70 space-x-1 bg-black"
        >
            <button>left</button>
            <button>right</button>
        </div>
        <div v-if="openedLightbox !== -1">
            <div
                class="z-10 bg-black top-0 fixed opacity-70 w-screen h-screen"
            />
            <div
                class="top-0 z-20 fixed w-screen h-screen flex items-center justify-between"
            >
                <button
                    @click="handleOpenLightbox(-1)"
                    class="z-20 bg-white m-4 p-2"
                >
                    x
                </button>

                <button
                    class="bg-white m-4 p-2"
                    @click="handleOpenLightbox(openedLightbox - 1)"
                    :disabled="openedLightbox === 0"
                >
                    left
                </button>
                <div>
                    <div
                        class="relative bg-neutral-200 border-2 border-neutral-400 w-60 h-60"
                    >
                        {{ artworkPhotos[openedLightbox] }}
                    </div>
                    <div class="text-center text-white">{{ artworkPhotos[openedLightbox].description }}</div>
                    <div class="flex space-x-3">
                        <div
                            class="bg-neutral-200 border-2 border-neutral-400 w-8 h-12"
                            v-for="(artworkPhoto, photoIndex) in artworkPhotos"
                        >
                            <div @click="handleOpenLightbox(photoIndex)">
                                {{artworkPhoto}}
                            </div>
                        </div>
                    </div>
                </div>
                <button
                    class="bg-white m-4 p-2"
                    @click="handleOpenLightbox(openedLightbox + 1)"
                    :disabled="openedLightbox === artworkPhotos.length - 1"
                >
                    right
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps(['artworkPhotos']);
const openedLightbox = ref(-1);

const handleOpenLightbox = (index) => {
    openedLightbox.value = index;
};
</script>
