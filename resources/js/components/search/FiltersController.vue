<script>
import queryString from 'query-string';
import axios from 'axios';

function getParsedUrl() {
    return queryString.parseUrl(window.location.href, {
        arrayFormat: 'bracket',
    });
}

export function stringifyUrl({ url, query }) {
    return queryString.stringifyUrl(
        { url, query },
        {
            arrayFormat: 'bracket',
        }
    );
}

const defaultQuery = {
    boroughs: [],
    authors: [],
    categories: [],
    keywords: [],
    materials: [],
    conditions: [],
}

export default {
    props: {
        initialFilters: {
            type: Object,
        },
    },

    data() {
        return {
            isFetching: false,
            artworks: [],
            filters: {},
            query: {
                ...defaultQuery,
                ...getParsedUrl().query,
            },
            isShowMoreOpen: false
        };
    },
    async created() {
        this.fetchData();
    },
    render() {
        return this.$slots.default({
            filters: this.filters,
            query: this.query,
            onCheckboxChange: this.onCheckboxChange,
            artworks: this.artworks,
            isFetching: this.isFetching,
            filterSelections: this.filterSelections,
            removeAllSelections: this.removeAllSelections,
            removeSelection: this.removeSelection,
            changeShowMoreOpen: this.changeShowMoreOpen,
            isShowMoreOpen: this.isShowMoreOpen
        });
    },
    computed: {
        filterSelections() {
            if (Object.keys(this.filters).length === 0) return [];

            return [
                ...this.query.boroughs.map((value) => ({
                    name: 'boroughs',
                    value,
                    label: this.filters.boroughs.find((f) => f.value === value)
                        .label,
                })),
                ...this.query.authors.map((value) => ({
                    name: 'authors',
                    value,
                    label: this.filters.authors.find((f) => f.value === value)
                        .label,
                })),
                ...this.query.categories.map((value) => ({
                    name: 'categories',
                    value,
                    label: this.filters.categories.find(
                        (f) => f.value === value
                    ).label,
                })),
                ...this.query.keywords.map((value) => ({
                    name: 'keywords',
                    value,
                    label: this.filters.keywords.find((f) => f.value === value)
                        .label,
                })),
                ...this.query.materials.map((value) => ({
                    name: 'materials',
                    value,
                    label: this.filters.materials.find((f) => f.value === value)
                        .label,
                })),
                ...this.query.conditions.map((value) => ({
                    name: 'conditions',
                    value,
                    label: this.filters.conditions.find((f) => f.value === value)
                        .label,
                })),
            ];
        },
    },
    methods: {
        changeShowMoreOpen(value) {
            this.isShowMoreOpen = value;
        },
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
        removeAllSelections() {
            this.query = defaultQuery
        },
        removeSelection({ name, value }) {
            this.query = {
                ...this.query,
                [name]: this.query[name].filter((v) => v !== value),
            };
        },
        async fetchData() {
            this.isFetching = true;

            try {
                this.filters = await axios
                    .get(
                        stringifyUrl({
                            url: '/api/artworks/filters',
                            query: this.query,
                        })
                    )
                    .then(({ data }) => data);

                // TODO merge into one call
                this.artworks = await axios
                    .get(
                        stringifyUrl({
                            url: '/api/artworks',
                            query: this.query,
                        })
                    )
                    .then(({ data }) => data);

                this.isFetching = false;
            } catch (e) {
                this.isFetching = false;
                throw e;
            }
        },
    },
    watch: {
        query(newQuery) {
            this.fetchData();

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
