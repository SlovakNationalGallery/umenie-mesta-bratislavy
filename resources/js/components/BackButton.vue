<template>
    <button @click="onClick">
        <slot />
    </button>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps(['fallback']);

const onClick = () => {
    if (document.referrer.startsWith(window.location.origin)) {
        window.history.back();
    } else {
        window.location = props.fallback;
    }
};
</script>
