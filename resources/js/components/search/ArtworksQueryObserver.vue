<script>
export default {
    props: {
        pageSize: {
            type: Number,
        },
        total: {
            type: Number,
        },
        query: {
            type: Object,
        },
    },
    emits: ['loadpage', 'resetquery'],
    data() {
        return {
            page: 1,
            // observer: new IntersectionObserver(this.observed),
        };
    },
    computed: {
        hasNextPage() {
            return this.page * this.pageSize < this.total;
        },
    },
    methods: {
        nextPage() {
            this.page++;
            const url = new URL(window.location.href);
            url.searchParams.set('page', this.page);
            axios.get(url.toString()).then((response) => {
                this.$emit('loadpage', response.data);
            });
        },
    },
    watch: {
        query() {
            this.page = 1;
            // this.observer.disconnect();
            axios.get(window.location.href).then((response) => {
                this.$emit('resetquery', response.data);
            });
        },
    },
    render() {
        return this.$slots.default({
            nextPage: this.nextPage,
            hasNextPage: this.hasNextPage,
        });
    },
};
</script>
