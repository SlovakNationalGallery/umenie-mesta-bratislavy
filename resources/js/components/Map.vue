<template>
    <div class="relative m-12 aspect-[674/720] h-96">
        <div class="absolute left-[34.07%] top-[52.08%] bottom-[15%] right-[24.87%]">
            <Danube class="absolute w-full h-full" />
        </div>
        <DistrictWrapper
            class="absolute left-[37.55%] top-[37.22%] bottom-[49.64%] right-[46.23%]"
            v-slot="{ isHovered, handleHoverChange }"
            :title="'Bratislava I'"
        >
            <DistrictI
                :class="[
                    isHovered ? 'stroke-red-500' : 'stroke-neutral-800',
                    'transition-colors absolute w-full h-full',
                ]"
                :handleHoverChange="handleHoverChange"
            >
            </DistrictI>
        </DistrictWrapper>
        <DistrictWrapper
            :title="'Bratislava II'"
            class="absolute left-[55.64%] top-[33.45%] bottom-[17.29%] right-[-0.02%]"
            v-slot="{ isHovered, handleHoverChange }"
        >
            <DistrictII
                :class="[
                    isHovered ? 'stroke-red-500' : 'stroke-neutral-800',
                    'transition-colors absolute w-full h-full',
                ]"
                :isHovered="isHovered"
                :handleHoverChange="handleHoverChange"
            >
            </DistrictII>
        </DistrictWrapper>
        <DistrictWrapper
            class="absolute left-[39.57%] top-[10.83%] bottom-[59.59%] right-[18.7%]"
            v-slot="{ isHovered, handleHoverChange }"
            :title="'Bratislava III'"
        >
            <DistrictIII
                :class="[
                    isHovered ? 'stroke-red-500' : 'stroke-neutral-800',
                    'transition-colors absolute w-full h-full',
                ]"
                :isHovered="isHovered"
                :handleHoverChange="handleHoverChange"
            >
            </DistrictIII>
        </DistrictWrapper>
        <DistrictWrapper
            class="absolute left-[0%] top-[0%] bottom-[55.35%] right-[49.46%]"
            v-slot="{ isHovered, handleHoverChange }"
            :title="'Bratislava IV'"
        >
            <DistrictIV
                :class="[
                    isHovered ? 'stroke-red-500' : 'stroke-neutral-800',
                    'transition-colors absolute w-full h-full',
                ]"
                :isHovered="isHovered"
                :handleHoverChange="handleHoverChange"
            >
            </DistrictIV>
        </DistrictWrapper>
        <DistrictWrapper
            class="absolute left-[31.07%] top-[54.53%] bottom-[-0.12%] right-[22.87%]"
            :title="'Bratislava V'"
            v-slot="{ isHovered, handleHoverChange }"
        >
            <DistrictV
                :class="[
                    isHovered ? 'stroke-red-500' : 'stroke-neutral-800',
                    'transition-colors absolute w-full h-full',
                ]"
                :isHovered="isHovered"
                :handleHoverChange="handleHoverChange"
            >
            </DistrictV>
        </DistrictWrapper>
    </div>
</template>

<script setup>
import DistrictWrapper from './DistrictWrapper.vue';
import DistrictI from './districts/DistrictI.vue';
import DistrictII from './districts/DistrictII.vue';
import DistrictIII from './districts/DistrictIII.vue';
import DistrictIV from './districts/DistrictIV.vue';
import DistrictV from './districts/DistrictV.vue';
import Danube from './districts/Danube.vue';

import { ref } from 'vue';

const isHovered = ref(false);
const handleHoverChange = (value) => (isHovered.value = value);
</script>
