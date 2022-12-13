<template>
    <div>
        <slot :options="this.filteredOptions"></slot>
    </div>
</template>

<script>
export default {
    props: {
        options: {
            // shape { label: string }[]
            type: Object,
        },
    },
    computed: {
        filteredOptions() {
            return this.options; // TODO
        },
    },
};
</script>
