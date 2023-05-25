<template>
    <slot v-if="page === 1" :loadMore="() => $emit('load-more')"></slot>
    <div ref="intersectionTrigger"></div>
</template>

<script>
export default {
    props: ['page'],
    emits: ['load-more'],
    data() {
        return {
            intersectionObserver: new IntersectionObserver(() => {
                if (this.page === 1) return;
                this.$emit('load-more');
            }),
        };
    },
    mounted() {
        this.intersectionObserver.observe(this.$refs.intersectionTrigger);
    },
};
</script>
