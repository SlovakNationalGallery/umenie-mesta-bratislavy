<template>
    <div ref="container" class="-mt-4 -mr-4">
        <slot></slot>
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
    },
    mounted() {
        this.masonry = new Masonry(this.$refs.container, {
            itemSelector: this.itemSelector,
        });
    },
    watch: {
        async query() {
            axios.get(window.location.href).then(({ data }) => {
                const responseDocument = document.createElement('html');
                responseDocument.innerHTML = data;

                const items = responseDocument.querySelectorAll(
                    this.itemSelector
                );

                // Remove children
                this.$refs.container.innerHTML = '';

                for (let item of items) {
                    const img = item.querySelector('img');
                    img.addEventListener('load', () => {
                        this.masonry.layout();
                    });
                    this.$refs.container.appendChild(item);
                }
                this.masonry.prepended(items);
            });
        },
    },
};
</script>
