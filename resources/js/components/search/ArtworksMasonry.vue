<template>
    <div>
        <div ref="container">
            <slot>
                <div
                    class="flex justify-center h-24 text-center text-neutral-500"
                >
                    Zadaným filtrom nevyhovujú žiadne diela.
                </div>
            </slot>
        </div>
        <div class="flex justify-center" v-if="hasNext" ref="more">
            <button
                v-if="page === 1"
                @click="page++"
                class="uppercase font-medium py-2.5 px-6 m-2 lg:m-4 leading-[1.125] border-black border-2"
            >
                Načítať ďalšie diela
            </button>
        </div>
    </div>
</template>

<script>
import Masonry from 'masonry-layout';
import axios from 'axios';

export default {
    props: {
        itemSelector: {
            type: String,
        },
        query: {
            type: Object,
        },
        initialHasNext: {
            type: Boolean,
        },
    },
    data() {
        return {
            page: 1,
            hasNext: this.initialHasNext,
            observer: new IntersectionObserver(this.observed),
        };
    },
    mounted() {
        this.masonry = new Masonry(this.$refs.container, {
            itemSelector: this.itemSelector,
        });

        for (let img of this.$refs.container.querySelectorAll('img')) {
            img.addEventListener('load', () => {
                this.masonry.layout();
            });
        }
    },
    methods: {
        observed(entries) {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    this.observer.unobserve(entry.target);
                    this.page++;
                }
            });
        },
        itemsFromResponse({ data }) {
            const responseDocument = document.createElement('html');
            responseDocument.innerHTML = data;
            const items = responseDocument.querySelectorAll(this.itemSelector);

            for (let item of items) {
                const img = item.querySelector('img');
                img.addEventListener('load', () => {
                    this.masonry.layout();
                });
                this.$refs.container.appendChild(item);
            }

            this.hasNext = items.length;
            this.$nextTick(() => {
                if (this.$refs.more && this.page > 1) {
                    this.observer.observe(this.$refs.more);
                }
            });
            return items;
        },
    },
    watch: {
        async page() {
            const url = new URL(window.location.href);
            url.searchParams.append('page', this.page);
            axios
                .get(url.toString())
                .then(this.itemsFromResponse)
                .then((items) => {
                    this.masonry.appended(items);
                });
        },
        async query() {
            this.page = 1;
            this.observer.disconnect();
            this.$refs.container.innerHTML = '';
            axios
                .get(window.location.href)
                .then(this.itemsFromResponse)
                .then((items) => {
                    this.masonry.prepended(items);
                });
        },
    },
};
</script>
