<script>
import queryString from 'query-string';
import axios from 'axios';

function getParsedUrl() {
    return queryString.parseUrl(window.location.href, {
        arrayFormat: 'bracket',
    });
}

function stringifyUrl({ url, query }) {
    return queryString.stringifyUrl(
        { url, query },
        {
            arrayFormat: 'bracket',
        }
    );
}

export default {
    props: {
        initialFilters: {
            type: Object,
        },
    },

    data() {
        return {
            filters: {},
            query: {
                boroughs: [],
                authors: [],
                categories: [],
                keywords: [],
                ...getParsedUrl().query,
            },
        };
    },
    async created() {
        this.fetchFilters();
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
        async fetchFilters() {
            const url = stringifyUrl({
                url: '/api/artworks/filters',
                query: this.query,
            });

            const filtersResponse = await axios.get(url);
            this.filters = filtersResponse.data;
        },
    },
    watch: {
        query(newQuery) {
            this.fetchFilters();

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
