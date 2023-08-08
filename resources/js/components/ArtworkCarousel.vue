<template>
    <div class="relative" v-if="photos.length">
        <div
            v-if="photos.length === 1"
            class="h-96 w-full overflow-hidden cursor-pointer"
            @click="handleOpenLightbox(0)"
        >
            <img
                :src="photos[0].url"
                :srcset="photos[0].srcSet"
                class="object-cover h-full w-full hover:scale-105 transition-all duration-500"
            />
        </div>
        <div class="flex space-x-1" v-else-if="photos.length > 1">
            <div
                class="h-96 w-2/3 overflow-hidden cursor-pointer"
                @click="handleOpenLightbox(0)"
            >
                <img
                    :src="photos[0].url"
                    :srcset="photos[0].srcSet"
                    class="h-full w-full object-cover hover:scale-105 transition-all duration-500"
                />
            </div>
            <div
                class="h-96 w-1/3 overflow-hidden cursor-pointer"
                @click="handleOpenLightbox(1)"
            >
                <img
                    :src="photos[1].url"
                    :srcset="photos[1].srcSet"
                    class="h-full w-full object-cover hover:scale-105 transition-all duration-500"
                />
            </div>
        </div>
        <button
            @click="handleOpenLightbox(0)"
            class="absolute min-w-max bottom-4 left-1/2 -translate-x-1/2 bg-white uppercase font-medium py-2.5 px-5 lg:right-4 lg:left-auto lg:transform-none hover:text-white hover:bg-red-500 hover:border-transparent transition-all duration-150"
        >
            zobraziť galériu <span>({{ photos.length }})</span>
        </button>
    </div>
    <transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition duration-150 ease-in"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div v-show="openedLightbox !== null" class="fixed inset-0 z-10">
            <div
                class="absolute inset-0 h-full lg:px-10 bg-white/95 overflow-hidden"
                @click="handleOpenLightbox(null)"
            >
                <div class="absolute inset-4 flex flex-col mt-24">
                    <div
                        class="flex h-full overflow-x-auto snap-mandatory snap-x hide-scrollbar gap-4"
                    >
                        <div
                            v-for="(photo, i) in photos"
                            ref="slidesRefs"
                            :photo-index="i"
                            class="shrink-0 flex flex-col max-w-full snap-center h-full"
                        >
                            <div class="min-h-0 flex-1">
                                <img
                                    :src="photo.url"
                                    :srcset="photo.srcSet"
                                    :alt="photo.description"
                                    class="object-contain w-full h-full"
                                />
                            </div>
                            <div @click.stop>
                                <div
                                    class="mt-6 mx-6 pb-1 lg:pb-2 font-medium text-xl text-center text-neutral-800"
                                >
                                    {{ photos[i]?.description }}
                                </div>
                                <div
                                    :class="[
                                        {
                                            invisible: !photos[i]?.source,
                                        },
                                        'mx-6 pb-10 lg:pb-20 font-medium text-sm text-center text-neutral-800',
                                    ]"
                                >
                                    Zdroj: {{ photos[i]?.source }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button
                class="absolute top-1/2 left-1 lg:left-10 rounded-full w-8 h-8 lg:w-10 lg:h-10 flex items-center justify-center stroke-white bg-neutral-800 disabled:opacity-30"
                @click="previousPhoto"
                :disabled="openedLightbox === 0"
            >
                <svg
                    class="lg:w-[21px] lg:h-[18px] w-[17px] h-[15px]"
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
            <button
                class="absolute top-1/2 right-1 lg:right-10 rounded-full w-8 h-8 lg:w-10 lg:h-10 flex items-center justify-center stroke-white bg-neutral-800 disabled:opacity-30"
                @click="nextPhoto"
                :disabled="openedLightbox === photos.length - 1"
            >
                <svg
                    class="lg:w-[21px] lg:h-[18px] w-[17px] h-[15px]"
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
            <button
                @click="handleOpenLightbox(null)"
                class="absolute top-9 right-4 lg:top-10 lg:right-10 bg-neutral-800 rounded-full w-8 h-8 lg:w-10 lg:h-10 flex items-center justify-center stroke-white"
            >
                <svg
                    class="lg:w-[26px] lg:h-[26px] w-[21px] h-[21px]"
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
    </transition>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps(['photos']);
const openedLightbox = ref(null);
const slidesRefs = ref([]);
const intersectionObserver = new IntersectionObserver(
    (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                openedLightbox.value = Number(
                    entry.target.getAttribute('photo-index')
                );
            }
        });
    },
    { threshold: 1 }
);

const onKeyDown = ({ code }) => {
    if (code === 'ArrowRight') nextPhoto();
    if (code === 'ArrowLeft') previousPhoto();
    if (code === 'Escape') handleOpenLightbox(null);
};

onMounted(() => {
    window.addEventListener('keydown', onKeyDown);
    slidesRefs.value.map((slideRef) => intersectionObserver.observe(slideRef));
});

onUnmounted(() => {
    window.addEventListener('keydown', onKeyDown);
    intersectionObserver.disconnect();
});

const nextPhoto = () => {
    if (openedLightbox.value === null) return;
    if (openedLightbox.value === props.photos.length - 1) return;
    openedLightbox.value += 1;
};

const previousPhoto = () => {
    if (openedLightbox.value === null) return;
    if (openedLightbox.value === 0) return;
    openedLightbox.value -= 1;
};

const handleOpenLightbox = (index) => {
    openedLightbox.value = index;
};

watch(openedLightbox, (newOpenedLightbox) => {
    newOpenedLightbox !== null &&
        slidesRefs.value[newOpenedLightbox].scrollIntoView({
            behavior: 'smooth',
        });
});
</script>
