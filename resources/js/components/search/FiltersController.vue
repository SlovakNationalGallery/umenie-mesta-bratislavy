<script>
export default {
    props: {
        initialFilters: {
            type: Object,
        },
    },

    data() {
        return {
            filters: this.initialFilters ?? {},
        };
    },

    render() {
        return this.$slots.default({
            filters: this.filters,
        });
    },
};
</script>
