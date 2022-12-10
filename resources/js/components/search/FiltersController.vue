<script>
import queryString from 'query-string';

function getParsedUrl() {
    return queryString.parseUrl(window.location.href, {
        arrayFormat: 'bracket',
    });
}

export default {
    props: {
        initialFilters: {
            type: Object,
        },
    },

    data() {
        return {
            filters: this.initialFilters ?? {},
            query: {
                boroughs: [],
                authors: [],
                categories: [],
                keywords: [],
                ...getParsedUrl().query,
            },
        };
    },

    render() {
        return this.$slots.default({
            filters: this.filters,
            query: this.query,
            onCheckboxChange: this.onCheckboxChange,
        });
    },
    methods: {
        onCheckboxChange(event) {
            const { name, value, checked } = event.target;

            if (checked) {
                // Add to query
                this.query = {
                    ...this.query,
                    [name]: [...this.query[name], value],
                };
                return;
            }

            // Remove from query
            this.query = {
                ...this.query,
                [name]: this.query[name].filter((v) => v !== value),
            };
        },
    },
    watch: {
        query(newQuery) {
            const { url } = getParsedUrl();

            const newUrl = queryString.stringifyUrl(
                {
                    url,
                    query: { ...newQuery },
                },
                {
                    arrayFormat: 'bracket',
                }
            );

            window.history.replaceState(
                newUrl,
                '', // unused param
                newUrl
            );
        },
    },
};
</script>
